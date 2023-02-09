import CartTemplate from "@/components/templates/cart";
import HomeLayout from "@/layout/HomeLayout";
import React, { ReactElement } from "react";

const Cart = () => {
  return <CartTemplate />;
};

Cart.getLayout = function getLayout(page: ReactElement) {
  return <HomeLayout>{page}</HomeLayout>;
};

export default Cart;
