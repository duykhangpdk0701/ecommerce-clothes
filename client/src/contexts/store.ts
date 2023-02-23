import {
  configureStore,
  ThunkAction,
  Action,
  combineReducers,
  Store,
} from "@reduxjs/toolkit";
import { createWrapper } from "next-redux-wrapper";
import {
  persistStore,
  persistReducer,
  FLUSH,
  REHYDRATE,
  PAUSE,
  PERSIST,
  PURGE,
  REGISTER,
} from "redux-persist";
import storage from "redux-persist/lib/storage";
import CartDrawerReducer from "@/contexts/slices/cartDrawerSlice";
import CustomizationReducer from "@/contexts/slices/customizationSlice";
import SnackbarSliceReducer from "@/contexts/slices/snackbarSlice";

const persistConfig = {
  key: "root",
  storage,
  blacklist: ["cartDrawer", "customizationSlice", "snackbar"],
};

const rootReducer = combineReducers({
  CartDrawer: CartDrawerReducer,
  Customization: CustomizationReducer,
  SnackBarSlice: SnackbarSliceReducer,
});

const persistedReducer = persistReducer(persistConfig, rootReducer);

export const store = () =>
  configureStore({
    reducer: persistedReducer,
    middleware: (getDefaultMiddleware) =>
      getDefaultMiddleware({
        serializableCheck: {
          ignoredActions: [FLUSH, REHYDRATE, PAUSE, PERSIST, PURGE, REGISTER],
        },
      }),
  });

export const persistor = persistStore(store());

export type AppDispatch = Store["dispatch"];

export type RootState = ReturnType<Store["getState"]>;

export type AppThunk<ReturnType = void> = ThunkAction<
  ReturnType,
  RootState,
  unknown,
  Action<string>
>;

export const wrapper = createWrapper(store);
