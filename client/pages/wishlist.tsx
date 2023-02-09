import WishlistTemplate from "@/components/templates/wishlist";
import AccountLayout from "@/layout/AccountLayout";
import React, { ReactElement } from "react";

const Wishlist = () => {
  return <WishlistTemplate />;
};

Wishlist.getLayout = function getLayout(page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default Wishlist;
