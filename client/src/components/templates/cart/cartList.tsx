import IQuotes from "@/interfaces/Quotes";
import React, { FC } from "react";
import CartItem from "./cartItem";
import CartItemLoading from "./cartItemLoading";
interface ICartList {
  data?: IQuotes;
  loading: boolean;
}

const cartLoading = [
  <CartItemLoading />,
  <CartItemLoading />,
  <CartItemLoading />,
  <CartItemLoading />,
];

const CartList: FC<ICartList> = (props) => {
  const { data, loading } = props;
  return (
    <div>
      {loading
        ? cartLoading.map((item) => <>{item}</>)
        : data?.quote_detail.map((item) => (
            <CartItem key={item.id} data={item} />
          ))}
    </div>
  );
};

export default CartList;
