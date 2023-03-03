import { createSlice, PayloadAction } from "@reduxjs/toolkit";

export interface IListProductSlice {
  listType: "grid" | "list";
}

const initialState: IListProductSlice = {
  listType: "grid",
};

export const ListProductSlice = createSlice({
  name: "list-product-slice",
  initialState,
  reducers: {
    setListAciton: (state, action: PayloadAction<"grid" | "list">) => {
      state.listType = action.payload;
    },
  },
});

export const { setListAciton } = ListProductSlice.actions;

export default ListProductSlice.reducer;
