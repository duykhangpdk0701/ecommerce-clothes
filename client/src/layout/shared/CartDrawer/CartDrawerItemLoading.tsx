import Skeleton from "@mui/material/Skeleton";
import React from "react";

const CartDrawerItemLoading = () => {
  return (
    <div className="px-5 py-4 flex items-center border-0 border-b border-solid border-color-gray">
      <div className="flex flex-col items-center">
        <Skeleton variant="circular" width={40} height={40} />
        <Skeleton variant="text" className="text-sm w-2" />
        <Skeleton variant="circular" width={40} height={40} />
      </div>

      <Skeleton variant="rectangular" className="mx-4" width={76} height={76} />

      <div className="text-ellipsis overflow-hidden flex-1 whitespace-nowrap">
        <Skeleton variant="text" className="text-sm w-16" />
        <Skeleton variant="text" className="text-sm w-36" />
        <Skeleton variant="text" className="text-sm w-20" />
      </div>
    </div>
  );
};

export default CartDrawerItemLoading;
