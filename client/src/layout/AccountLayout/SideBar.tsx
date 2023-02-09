import {
  FavoriteBorder,
  LocationOn,
  Payment,
  Person,
  ShoppingBagOutlined,
} from "@mui/icons-material";
import { Paper } from "@mui/material";
import Link from "next/link";
import React from "react";
import { TEXT_COLOR_GRAY } from "@/styles/color";

const SideBar = () => {
  return (
    <Paper className="pb-6">
      <p
        className="uppercase text-xs px-7 pt-7 pb-4"
        style={{ color: TEXT_COLOR_GRAY }}
      >
        DashBoard
      </p>
      <Link
        href={"/orders"}
        className="flex justify-between px-6 mb-5 no-underline border-0 border-l-4 border-[#d23f57] border-solid text-[#d23f57]"
      >
        <div className="flex gap-2 items-center">
          <ShoppingBagOutlined className="text-xl" />
          <span>Orders</span>
        </div>
        <span>5</span>
      </Link>
      <Link
        href={"/wishlist"}
        className="flex justify-between px-6 mb-5 no-underline border-0 border-l-4 border-transparent border-solid"
        style={{ color: TEXT_COLOR_GRAY }}
      >
        <div className="flex gap-2 items-center">
          <FavoriteBorder className="text-xl" />
          <span>Wishlist</span>
        </div>
        <span>0</span>
      </Link>

      <p
        className="uppercase text-xs px-7 pt-7 pb-4"
        style={{ color: TEXT_COLOR_GRAY }}
      >
        Account settings
      </p>

      <Link
        href={"/profile"}
        className="flex justify-between px-6 mb-5 no-underline border-0 border-l-4 border-transparent border-solid"
        style={{ color: TEXT_COLOR_GRAY }}
      >
        <div className="flex gap-2 items-center">
          <Person className="text-xl" />
          <span>Profile Info</span>
        </div>
        <span>0</span>
      </Link>

      <Link
        href={"/address"}
        className="flex justify-between px-6 mb-5 no-underline border-0 border-l-4 border-transparent border-solid"
        style={{ color: TEXT_COLOR_GRAY }}
      >
        <div className="flex gap-2 items-center">
          <LocationOn className="text-xl" />
          <span>Addresses</span>
        </div>
        <span>0</span>
      </Link>

      <Link
        href={"/payment-methods"}
        className="flex justify-between px-6 mb-5 no-underline border-0 border-l-4 border-transparent border-solid"
        style={{ color: TEXT_COLOR_GRAY }}
      >
        <div className="flex gap-2 items-center">
          <Payment className="text-xl" />
          <span>Payment Methods</span>
        </div>
        <span>0</span>
      </Link>
    </Paper>
  );
};

export default SideBar;
