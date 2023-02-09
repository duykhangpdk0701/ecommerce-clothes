import { Chip } from "@mui/material";
import Link from "next/link";
import { useRouter } from "next/router";
import React from "react";

const CartBreadCrumb = () => {
  const route = useRouter();

  return (
    <div className="mb-6">
      <div>
        <div className="pt-6 flex items-center justify-center">
          <Link href="/cart" passHref legacyBehavior>
            <Chip
              label="1. Carts"
              clickable
              color="primary"
              className={`${
                route.pathname === "/cart" ? "" : "bg-[#bbdefb] text-[#1976d2]"
              } text-sm py-2 px-4 font-semibold`}
              sx={{
                ":hover": {
                  color: "#fff",
                },
              }}
            />
          </Link>
          <div className="w-12 h-1 bg-[#bbdefb]"></div>

          <Link href="/checkout" passHref legacyBehavior>
            <Chip
              label="2. Details"
              clickable
              color="primary"
              className={`${
                route.pathname === "/checkout"
                  ? ""
                  : "bg-[#bbdefb] text-[#1976d2]"
              } text-sm py-2 px-4 font-semibold`}
              sx={{
                ":hover": {
                  color: "#fff",
                },
              }}
            />
          </Link>
          <div className="w-12 h-1 bg-[#bbdefb]"></div>

          <Link href="payment" passHref legacyBehavior>
            <Chip
              label="3. Payment"
              clickable
              color="primary"
              className={`${
                route.pathname === "/payment"
                  ? ""
                  : "bg-[#bbdefb] text-[#1976d2]"
              } text-sm py-2 px-4 font-semibold`}
              sx={{
                ":hover": {
                  color: "#fff",
                },
              }}
            />
          </Link>
          <div className="w-12 h-1 bg-[#bbdefb]"></div>
          <Link href="review" passHref legacyBehavior>
            <Chip
              label="4. Review"
              clickable
              color="primary"
              className={`${
                route.pathname === "/review"
                  ? ""
                  : "bg-[#bbdefb] text-[#1976d2]"
              } text-sm py-2 px-4 font-semibold`}
              sx={{
                ":hover": {
                  color: "#fff",
                },
              }}
            />
          </Link>
        </div>
      </div>
    </div>
  );
};

export default CartBreadCrumb;
