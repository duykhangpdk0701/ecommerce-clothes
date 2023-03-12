import Skeleton from "@mui/material/Skeleton";
import Paper from "@mui/material/Paper";
import React from "react";

const CartItemLoading = () => {
  return (
    <Paper className="mb-5 flex relative">
      <Skeleton variant="rectangular" width={140} height={140} />
      <div className="flex-1 flex flex-col justify-between items-start p-4">
        <Skeleton variant="text" className="text-lg w-28" />
        <Skeleton variant="text" className="text-lg w-48" />
        <Skeleton variant="text" className="text-lg w-20" />
      </div>
    </Paper>
  );
};

export default CartItemLoading;
