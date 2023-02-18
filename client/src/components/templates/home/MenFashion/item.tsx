import React from "react";
//mui Button
import Button from "@mui/material/Button";
import Rating from "@mui/material/Rating";

import Link from "next/link";
import product_1 from "@/assets/images/products/product_1.jpg";
import Image from "next/image";

const MenFashionItem = () => {
  return (
    <div className="px-4">
      <div className="bg-white">
        <div>
          <Link href={"/product"} className="block w-full h-[225px] relative">
            <Image
              src={product_1.src}
              alt="product1"
              fill
              className="object-cover"
            />
          </Link>
        </div>
        <div className="p-4 text-center">
          <p className="text-sm">Silver High Neck Sweater</p>
          <h4 className="text-lg py-1">210,00 US$</h4>
          <div className="flex items-center justify-center gap-2 mb-4">
            <Rating name="read-only" className="text-sm" value={4} readOnly />
            <small className="text-xs">({0})</small>
          </div>
          <Button variant="outlined" color="inherit" fullWidth>
            Add To Cart
          </Button>
        </div>
      </div>
    </div>
  );
};

export default MenFashionItem;
