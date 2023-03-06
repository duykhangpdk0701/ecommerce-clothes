import React, { FC, ReactElement } from "react";
import { BACKGROUND_COLOR } from "@/styles/color";
import Header from "../shared/Header";
import CartDrawer from "../shared/CartDrawer";
import { useQuery } from "react-query";
import cartAPI from "@/api/cartAPI";

interface IHomeLayout {
  children: ReactElement;
}

const HomeLayout: FC<IHomeLayout> = ({ children }) => {
  const cartQuery = useQuery({
    queryKey: ["cart"],
    queryFn: () => cartAPI.getQuoteByUser(),
    onSuccess: (data) => {
      sessionStorage.setItem("quoteId", data.id.toString());
    },
  });

  return (
    <>
      <Header
        quoteItemLength={
          cartQuery.data ? cartQuery.data.quote_detail.length : 0
        }
      />
      <main className={`bg-[${BACKGROUND_COLOR}]`}>{children}</main>
      <CartDrawer
        data={cartQuery?.data?.quote_detail}
        quoteItemLength={
          cartQuery.data ? cartQuery.data.quote_detail.length : 0
        }
      />
    </>
  );
};

export default HomeLayout;
