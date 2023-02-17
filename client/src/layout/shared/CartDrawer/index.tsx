import Link from "next/link";
import React from "react";
import { setCloseCartDrawer } from "../../../contexts/slices/cartDrawerSlice";
import { useAppDispatch, useAppSelector } from "@/hooks/redux";
import CartDrawerItem from "./CartDrawerItem";
//mui component
import Button from "@mui/material/Button";
import Divider from "@mui/material/Divider";
import Drawer from "@mui/material/Drawer";
import IconButton from "@mui/material/IconButton";
//mui icon
import CloseIcon from "@mui/icons-material/Close";
import ShoppingBagOutlinedIcon from "@mui/icons-material/ShoppingBagOutlined";

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
              <ShoppingBagOutlinedIcon />
              <span className="ml-2 text-base font-semibold">3 item</span>
            </div>
            <IconButton onClick={handleOnCloseCartDrawer}>
              <CloseIcon />
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
