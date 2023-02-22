import ShoppingBagIcon from "@mui/icons-material/ShoppingBag";
import Pagination from "@mui/material/Pagination";
import React from "react";
import { TEXT_COLOR_GRAY } from "@/styles/color";
import ListOrderItems from "./ListOrderItems";

const ListOrdersTemplate = () => {
  return (
    <div>
      <div className="mt-4 mb-6">
        <div className="flex gap-3 items-center">
          <ShoppingBagIcon className="text-2xl" />
          <h2 className="text-2xl">My Orders</h2>
        </div>
      </div>
      <div className="mx-4 flex">
        <h5 className="flex-1 text-base" style={{ color: TEXT_COLOR_GRAY }}>
          Order #
        </h5>
        <h5 className="flex-1 text-base" style={{ color: TEXT_COLOR_GRAY }}>
          Status
        </h5>
        <h5 className="flex-1 text-base" style={{ color: TEXT_COLOR_GRAY }}>
          Date purchase
        </h5>
        <h5 className="flex-1 text-base" style={{ color: TEXT_COLOR_GRAY }}>
          Total
        </h5>
        <h5 className="mx-[22px]"></h5>
      </div>

      <ListOrderItems />
      <ListOrderItems />
      <ListOrderItems />
      <ListOrderItems />
      <ListOrderItems />

      <div className="mt-10 flex justify-center">
        <Pagination count={5} variant="outlined" color="primary" />
      </div>
    </div>
  );
};

export default ListOrdersTemplate;
