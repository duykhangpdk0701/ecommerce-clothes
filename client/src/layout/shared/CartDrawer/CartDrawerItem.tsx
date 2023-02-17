import Image from "next/image";
import Link from "next/link";
import React from "react";
import product1PNG from "../../../assets/product1.png";
//mui component
import Button from "@mui/material/Button";
import IconButton from "@mui/material/IconButton";
import Avatar from "@mui/material/Avatar";
//mui icon
import CloseIcon from "@mui/icons-material/Close";
import AddIcon from "@mui/icons-material/Add";
import RemoveIcon from "@mui/icons-material/Remove";

const CartDrawerItem = () => {
  return (
    <div className="px-5 py-4 flex items-center border-0 border-b border-solid border-color-gray">
      <div className="flex flex-col items-center">
        <Button
          size="small"
          variant="outlined"
          className="min-w-0 p-1 rounded-full"
        >
          <AddIcon />
        </Button>

        <span className="my-1">1</span>
        <Button
          size="small"
          variant="outlined"
          className="min-w-0 p-1 rounded-full"
        >
          <RemoveIcon />
        </Button>
      </div>
      <Link href="/product/silver">
        <Avatar variant="square" className="bg-white w-[76px] h-[76px] mx-4">
          <Image src={product1PNG.src} fill alt="product1" />
        </Avatar>
      </Link>
      <div className="text-ellipsis overflow-hidden flex-1 whitespace-nowrap">
        <Link href="/product/silver" className="no-underline text-color-black">
          <h5 className="text-sm font-semibold overflow-hidden text-ellipsis whitespace-nowrap ">
            Silver High Neck Sweat
          </h5>
        </Link>
        <span className="text-xs mt-1 block text-color-gray">
          210,00 US$ x 1
        </span>
        <span className="text-sm font-semibold mt-1 block">210,00 US$</span>
      </div>
      <IconButton className="ml-5">
        <CloseIcon />
      </IconButton>
    </div>
  );
};

export default CartDrawerItem;
