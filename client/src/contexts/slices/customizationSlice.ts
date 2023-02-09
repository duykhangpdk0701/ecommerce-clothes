import { createSlice, PayloadAction } from "@reduxjs/toolkit";

export interface ICustomizationSlice {
  isOpen: string[]; // for active default menu
}

const initialState: ICustomizationSlice = {
  isOpen: [],
};

export const CustomizationSlice = createSlice({
  name: "customizationSlice",
  initialState,
  reducers: {
    menuOpenAction: (state, action: PayloadAction<string>) => {
      state.isOpen = [action.payload];
    },
  },
});

export const { menuOpenAction } = CustomizationSlice.actions;

export default CustomizationSlice.reducer;
