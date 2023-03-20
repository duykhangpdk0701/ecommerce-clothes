import FavoriteBorderIcon from "@mui/icons-material/FavoriteBorder";
import LocationOnIcon from "@mui/icons-material/LocationOn";
import PaymentIcon from "@mui/icons-material/Payment";
import PersonIcon from "@mui/icons-material/Person";
import ShoppingBagOutlinedIcon from "@mui/icons-material/ShoppingBagOutlined";
import Paper from "@mui/material/Paper";
import Link from "next/link";
import { useRouter } from "next/router";
import React, { useEffect } from "react";

const SideBar = () => {
  const router = useRouter();

  useEffect(() => {
    console.log(router.pathname);
  });

  return (
    <Paper className="pb-6">
      <p className="uppercase text-xs px-7 pt-7 pb-4 text-color-gray">
        DashBoard
      </p>
      <Link
        href={"/order"}
        className={`flex justify-between px-6 mb-5 no-underline  text-color-gray border-0 border-l-4 border-solid  ${
          router.pathname === "/order"
            ? "border-[#d23f57] text-color-price"
            : "border-transparent"
        }`}
      >
        <div className="flex gap-2 items-center">
          <ShoppingBagOutlinedIcon className="text-xl" />
          <span>Orders</span>
        </div>
        <span></span>
      </Link>
      {/* <Link
        href={"/wishlist"}
        className={`flex justify-between px-6 mb-5 no-underline  text-color-gray border-0 border-l-4 border-solid  ${
          router.pathname === "/wishlist"
            ? "border-[#d23f57] text-color-price"
            : "border-transparent"
        }`}
      >
        <div className="flex gap-2 items-center">
          <FavoriteBorderIcon className="text-xl" />
          <span>Wishlist</span>
        </div>
        <span></span>
      </Link> */}

      <p className="uppercase text-xs px-7 pt-7 pb-4 text-color-gray">
        Account settings
      </p>

      <Link
        href={"/profile"}
        className={`flex justify-between px-6 mb-5 no-underline  text-color-gray border-0 border-l-4 border-solid  ${
          router.pathname === "/profile"
            ? "border-[#d23f57] text-color-price"
            : "border-transparent"
        }`}
      >
        <div className="flex gap-2 items-center">
          <PersonIcon className="text-xl" />
          <span>Profile Info</span>
        </div>
        <span></span>
      </Link>

      <Link
        href={"/address"}
        className={`flex justify-between px-6 mb-5 no-underline  text-color-gray border-0 border-l-4 border-solid  ${
          router.pathname === "/address"
            ? "border-[#d23f57] text-color-price"
            : "border-transparent"
        }`}
      >
        <div className="flex gap-2 items-center">
          <LocationOnIcon className="text-xl" />
          <span>Addresses</span>
        </div>
        <span></span>
      </Link>

      <Link
        href={"/payment-methods"}
        className={`flex justify-between px-6 mb-5 no-underline  text-color-gray border-0 border-l-4 border-solid  ${
          router.pathname === "/payment-methods"
            ? "border-[#d23f57] text-color-price"
            : "border-transparent"
        }`}
      >
        <div className="flex gap-2 items-center">
          <PaymentIcon className="text-xl" />
          <span>Payment Methods</span>
        </div>
        <span></span>
      </Link>
    </Paper>
  );
};

export default SideBar;
