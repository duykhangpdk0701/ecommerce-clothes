import Paper from "@mui/material/Paper";
import Skeleton from "@mui/material/Skeleton";
import React from "react";

const ListAddressItemLoading = () => {
  return (
    <Paper className="my-4 py-1.5 px-4 pr-8 flex items-center">
      <h5 className="flex-1 text-base whitespace-nowrap text-ellipsis overflow-hidden">
        <Skeleton className="text-base w-32" />
      </h5>

      <p className="flex-[260px]">
        <Skeleton className="text-base w-96" />
      </p>
      <p className="flex-1">
        <Skeleton className="text-base w-24" />
      </p>
      <p className="h-9 flex items-center">
        <Skeleton variant="rounded" className="text-base w-5 h-5" />
        <Skeleton variant="rounded" className="text-base w-5 h-5 ml-2" />
      </p>
    </Paper>
  );
};

export default ListAddressItemLoading;
