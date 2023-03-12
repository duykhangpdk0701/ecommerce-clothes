import cartAPI from "@/api/cartAPI";
import CartTemplate from "@/components/templates/cart";
import CartList from "@/components/templates/cart/cartList";
import CartTotal from "@/components/templates/cart/cartTotal";
import HomeLayout from "@/layout/HomeLayout";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";

const Cart = () => {
  const cartQuery = useQuery({
    queryKey: ["cart"],
    queryFn: () => cartAPI.getQuoteByUser(),
    onSuccess: (data) => {
      sessionStorage.setItem("quoteId", data.id.toString());
    },
  });

  return (
    <CartTemplate
      cartList={
        <CartList data={cartQuery.data} loading={cartQuery.isLoading} />
      }
      cartTotal={<CartTotal />}
    />
  );
};

Cart.getLayout = function getLayout(page: ReactElement) {
  return <HomeLayout>{page}</HomeLayout>;
};

export default Cart;
