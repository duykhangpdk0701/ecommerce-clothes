import React, { FC, ReactElement, useState } from "react";
import { BACKGROUND_COLOR } from "@/styles/color";
import Header from "../shared/Header";
import CartDrawer from "../shared/CartDrawer";

interface IHomeLayout {
  children: ReactElement;
}

const HomeLayout: FC<IHomeLayout> = ({ children }) => {
  return (
    <>
      <Header />
      <main className={`bg-[${BACKGROUND_COLOR}]`}>{children}</main>
      <CartDrawer />
    </>
  );
};

export default HomeLayout;
