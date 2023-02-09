import { Close, ShoppingBagOutlined } from "@mui/icons-material";
import { Button, Divider, Drawer, IconButton } from "@mui/material";
import Link from "next/link";
import React from "react";
import { setCloseCartDrawer } from "../../../contexts/slices/cartDrawerSlice";
import { useAppDispatch, useAppSelector } from "@/hooks/redux";
import CartDrawerItem from "./CartDrawerItem";

const CartDrawer = () => {
  const cartDrawerState = useAppSelector((state) => state.CartDrawer);
  const dispatch = useAppDispatch();

  const handleOnCloseCartDrawer = () => {
    dispatch(setCloseCartDrawer());
  };

  return (
    <Drawer
      open={cartDrawerState.toggle}
      anchor="right"
      onClose={handleOnCloseCartDrawer}
    >
      <div className="w-[380px] flex flex-col h-full">
        <div className="flex-1">
          <div className="h-20 flex justify-between items-center mx-5">
            <div className="flex items-center">
              <ShoppingBagOutlined />
              <span className="ml-2 text-base font-semibold">3 item</span>
            </div>
            <IconButton onClick={handleOnCloseCartDrawer}>
              <Close />
            </IconButton>
          </div>
          <Divider />
          <div>
            <CartDrawerItem />
            <CartDrawerItem />
            <CartDrawerItem />
          </div>
        </div>
        <div className="p-5">
          <Button
            variant="contained"
            fullWidth
            className="mb-3"
            disableElevation
          >
            Checkout now
          </Button>
          <Button
            onClick={handleOnCloseCartDrawer}
            component={Link}
            variant="outlined"
            fullWidth
            href="/cart"
          >
            View cart
          </Button>
        </div>
      </div>
    </Drawer>
  );
};

export default CartDrawer;
