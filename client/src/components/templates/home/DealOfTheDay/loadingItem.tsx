import React from "react";
import Skeleton from "@mui/material/Skeleton";

const LoadingDealOfTheDayItem = () => {
  return (
    <div className="px-4">
      <div className="bg-white">
        <div>
          <Skeleton variant="rectangular" className="w-full h-[225px] block" />
        </div>
        <div className="p-4 text-center">
          <p className="text-sm flex justify-center">
            <Skeleton className="w-40" />
          </p>
          <h4 className="text-lg py-1 flex justify-center">
            <Skeleton className="w-28" />
          </h4>
          <div className="flex items-center justify-center gap-2 mb-4">
            <Skeleton className="w-24" />
          </div>

          <Skeleton variant="rounded" className="w-full h-9 block" />
        </div>
      </div>
    </div>
  );
};

export default LoadingDealOfTheDayItem;
