import { createSlice } from "@reduxjs/toolkit";

export interface ICartDrawerSlice {
  toggle: boolean;
}

const initialState: ICartDrawerSlice = {
  toggle: false,
};

export const CartDrawerSlice = createSlice({
  name: "cartDrawer",
  initialState,
  reducers: {
    toggleAction: (state) => {
      state.toggle = !state.toggle;
    },

    setOpenCartDrawer: (state) => {
      state.toggle = true;
    },

    setCloseCartDrawer: (state) => {
      state.toggle = false;
    },
  },
});

export const { toggleAction, setCloseCartDrawer, setOpenCartDrawer } =
  CartDrawerSlice.actions;

export default CartDrawerSlice.reducer;
