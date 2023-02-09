import { Close, Add, Remove } from "@mui/icons-material";
import { Button, IconButton, Avatar } from "@mui/material";
import Image from "next/image";
import Link from "next/link";
import React from "react";
import product1PNG from "../../../assets/product1.png";
import {
  TEXT_COLOR_BLACK,
  TEXT_COLOR_GRAY,
  DIVIDER_COLOR_GRAY,
} from "@/styles/color";

const CartDrawerItem = () => {
  return (
    <div
      className="px-5 py-4 flex items-center border-0 border-b border-solid"
      style={{ borderColor: DIVIDER_COLOR_GRAY }}
    >
      <div className="flex flex-col items-center">
        <Button
          size="small"
          variant="outlined"
          className="min-w-0 p-1 rounded-full"
        >
          <Add />
        </Button>

        <span className="my-1">1</span>
        <Button
          size="small"
          variant="outlined"
          className="min-w-0 p-1 rounded-full"
        >
          <Remove />
        </Button>
      </div>
      <Link href="/product/silver">
        <Avatar variant="square" className="bg-white w-[76px] h-[76px] mx-4">
          <Image src={product1PNG.src} fill alt="product1" />
        </Avatar>
      </Link>
      <div className="text-ellipsis overflow-hidden flex-1 whitespace-nowrap">
        <Link
          href="/product/silver"
          className="no-underline"
          style={{ color: TEXT_COLOR_BLACK }}
        >
          <h5 className="text-sm font-semibold overflow-hidden text-ellipsis whitespace-nowrap ">
            Silver High Neck Sweat
          </h5>
        </Link>
        <span className="text-xs mt-1 block" style={{ color: TEXT_COLOR_GRAY }}>
          210,00 US$ x 1
        </span>
        <span className="text-sm font-semibold mt-1 block">210,00 US$</span>
      </div>
      <IconButton className="ml-5">
        <Close />
      </IconButton>
    </div>
  );
};

export default CartDrawerItem;
