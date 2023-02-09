import { Add, Close, Remove } from "@mui/icons-material";
import { Button, IconButton, Paper } from "@mui/material";
import Image from "next/image";
import Link from "next/link";
import React from "react";
import product1 from "@/assets/product1.png";

const CartItem = () => {
  return (
    <Paper className="mb-5 flex relative">
      <Image height={140} width={140} src={product1.src} alt={"product1"} />
      <IconButton size="small" className="absolute right-4 top-4 ">
        <Close fontSize="small" />
      </IconButton>
      <div className="flex-1 flex flex-col justify-between p-4">
        <div>
          <Link href="/product/1" passHref legacyBehavior>
            <span className="text-lg font-semibold">
              Silver High Neck Sweater
            </span>
          </Link>
        </div>
        <div className="flex gap-2">
          <span className="text-[#7D879C] font-medium text-base">
            210,00 US$ x 1
          </span>
          <span className="text-[#1976d2] font-medium text-base">
            210,00 US$
          </span>
        </div>
        <div>
          <Button disabled variant="outlined" className="min-w-0 p-1">
            <Remove fontSize="small" />
          </Button>
          <span className="mx-2 font-medium text-base">1</span>
          <Button variant="outlined" className="min-w-0 p-1">
            <Add fontSize="small" />
          </Button>
        </div>
      </div>
    </Paper>
  );
};

export default CartItem;
