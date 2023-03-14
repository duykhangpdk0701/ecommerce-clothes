import { createSlice, PayloadAction } from "@reduxjs/toolkit";

export interface IDialogItemSlice {
  toggle: boolean;
  itemSlug?: string;
}

const initialState: IDialogItemSlice = {
  toggle: false,
};

export const DialogItemSlice = createSlice({
  name: "dialog-item-slice",
  initialState,
  reducers: {
    setCloseDialogAction: (state) => {
      state.toggle = false;
    },

    removeSlugDialogAction: (state) => {
      state.itemSlug = undefined;
    },

    setOpenDialogAction: (
      state,
      action: PayloadAction<{ itemSlug: string }>
    ) => {
      state.toggle = true;
      state.itemSlug = action.payload.itemSlug;
    },
  },
});

export const {
  setCloseDialogAction,
  setOpenDialogAction,
  removeSlugDialogAction,
} = DialogItemSlice.actions;

export default DialogItemSlice.reducer;
