import Skeleton from "@mui/material/Skeleton";
import Paper from "@mui/material/Paper";
import React from "react";

const ListOrderItemLoading = () => {
  return (
    <Paper className="my-4 py-1.5 px-4 pr-16 flex items-center">
      <h5 className="flex-1 text-base whitespace-nowrap text-ellipsis overflow-hidden">
        <Skeleton className="text-base w-32" />
      </h5>
      <div className="flex-1">
        <Skeleton variant="rounded" className="text-base w-20 h-6" />
      </div>
      <p className="flex-1">
        <Skeleton className="text-base w-20" />
      </p>
      <p className="flex-1">
        <Skeleton className="text-base w-24" />
      </p>
      <p className="h-9"></p>
    </Paper>
  );
};

export default ListOrderItemLoading;
