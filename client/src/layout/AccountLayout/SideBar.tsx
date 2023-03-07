import FavoriteBorderIcon from "@mui/icons-material/FavoriteBorder";
import LocationOnIcon from "@mui/icons-material/LocationOn";
import PaymentIcon from "@mui/icons-material/Payment";
import PersonIcon from "@mui/icons-material/Person";
import ShoppingBagOutlinedIcon from "@mui/icons-material/ShoppingBagOutlined";
import Paper from "@mui/material/Paper";
import Link from "next/link";
import React from "react";
import { TEXT_COLOR_GRAY } from "@/styles/color";

const SideBar = () => {
  return (
    <Paper className="pb-6">
      <p className="uppercase text-xs px-7 pt-7 pb-4 text-color-gray">
        DashBoard
      </p>
      <Link
        href={"/order"}
        className="flex justify-between px-6 mb-5 no-underline border-0 border-l-4 border-[#d23f57] border-solid text-color-gray"
      >
        <div className="flex gap-2 items-center">
          <ShoppingBagOutlinedIcon className="text-xl" />
          <span>Orders</span>
        </div>
        <span>5</span>
      </Link>
      <Link
        href={"/wishlist"}
        className="flex justify-between px-6 mb-5 no-underline border-0 border-l-4 border-transparent border-solid text-color-gray"
      >
        <div className="flex gap-2 items-center">
          <FavoriteBorderIcon className="text-xl" />
          <span>Wishlist</span>
        </div>
        <span>0</span>
      </Link>

      <p className="uppercase text-xs px-7 pt-7 pb-4 text-color-gray">
        Account settings
      </p>

      <Link
        href={"/profile"}
        className="flex justify-between px-6 mb-5 no-underline border-0 border-l-4 border-transparent border-solid text-color-gray"
      >
        <div className="flex gap-2 items-center">
          <PersonIcon className="text-xl" />
          <span>Profile Info</span>
        </div>
        <span>0</span>
      </Link>

      <Link
        href={"/address"}
        className="flex justify-between px-6 mb-5 no-underline border-0 border-l-4 border-transparent border-solid text-color-gray"
      >
        <div className="flex gap-2 items-center">
          <LocationOnIcon className="text-xl" />
          <span>Addresses</span>
        </div>
        <span>0</span>
      </Link>

      <Link
        href={"/payment-methods"}
        className="flex justify-between px-6 mb-5 no-underline border-0 border-l-4 border-transparent border-solid text-color-gray"
      >
        <div className="flex gap-2 items-center">
          <PaymentIcon className="text-xl" />
          <span>Payment Methods</span>
        </div>
        <span>0</span>
      </Link>
    </Paper>
  );
};

export default SideBar;
