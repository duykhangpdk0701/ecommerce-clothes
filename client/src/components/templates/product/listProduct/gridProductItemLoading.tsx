import Skeleton from "@mui/material/Skeleton";
import Paper from "@mui/material/Paper";
import React from "react";

const GridProductItemLoading = () => {
  return (
    <>
      <Paper>
        <Skeleton className="h-[270px] w-full" variant="rectangular" />
        <div className="p-4">
          <div className="flex">
            <div className="flex-1 mr-2">
              <Skeleton className="w-20" />
              <Skeleton className="w-24" />
              <div className="mt-1">
                <span className="font-semibold text-color-price">
                  <Skeleton className="w-28" />
                </span>
              </div>
            </div>
            <div className="flex flex-col justify-end">
              <Skeleton className="w-8 h-8" variant="rounded" />
            </div>
          </div>
        </div>
      </Paper>
    </>
  );
};

export default GridProductItemLoading;
