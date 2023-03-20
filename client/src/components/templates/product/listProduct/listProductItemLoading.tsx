import Paper from "@mui/material/Paper";
import Grid from "@mui/material/Grid";
import React from "react";
import Typography from "@mui/material/Typography";
import Skeleton from "@mui/material/Skeleton";

const ListProductItemLoading = () => {
  return (
    <Paper className="mb-5">
      <Grid container columnSpacing={1}>
        <Grid item xs={12} sm={3}>
          <div className="relative h-full">
            <Skeleton className="h-full w-[208px]" variant="rectangular" />
          </div>
        </Grid>
        <Grid item xs={12} sm={9}>
          <div className="flex flex-col justify-center h-full p-4">
            <Typography variant="h5" className="my-2 font-semibold text-base">
              <Skeleton variant="text" className="text-base w-24" />
            </Typography>

            <Skeleton variant="rounded" className="w-28  h-5" />
            <div className="flex items-center mt-2 mb-4">
              <Typography
                variant="h5"
                className="text-color-price text-base font-semibold"
              >
                <Skeleton variant="text" className="text-base w-36" />
              </Typography>
            </div>
            <div>
              <Skeleton variant="rounded" className="h-9 w-32" />
            </div>
          </div>
        </Grid>
      </Grid>
    </Paper>
  );
};

export default ListProductItemLoading;
