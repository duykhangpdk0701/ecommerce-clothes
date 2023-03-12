import IUser from "@/interfaces/User";
import React from "react";
import Grid from "@mui/material/Grid";
import Paper from "@mui/material/Paper";
import Typography from "@mui/material/Typography";
import Avatar from "@mui/material/Avatar";
import { Skeleton } from "@mui/material";

const InforLoading = () => {
  return (
    <div>
      <div className="mb-8">
        <Grid container spacing={3}>
          <Grid item md={6} xs={12}>
            <Paper className="py-3 px-8 h-full flex items-center">
              <Skeleton variant="circular" className="h-16 w-16" />
              <div className="ml-3 flex-1">
                <div className="flex justify-start flex-col">
                  <Skeleton variant="text" className="text-base" />
                  <div className="flex">
                    <Skeleton variant="text" className="w-20" />
                  </div>
                </div>
              </div>
            </Paper>
          </Grid>
          <Grid item md={6} xs={12}>
            <Grid container spacing={4}>
              <Grid item xs={6} sm={6} lg={3}>
                <Paper className="px-5 py-4 flex flex-col items-center">
                  <Skeleton variant="text" className="text-xl w-5" />
                  <small className="text-center">All Orders</small>
                </Paper>
              </Grid>
              <Grid item xs={6} sm={6} lg={3}>
                <Paper className="px-5 py-4 flex flex-col items-center">
                  <Skeleton variant="text" className="text-xl w-5" />
                  <small className="text-center">All Orders</small>
                </Paper>
              </Grid>
              <Grid item xs={6} sm={6} lg={3}>
                <Paper className="px-5 py-4 flex flex-col items-center">
                  <Skeleton variant="text" className="text-xl w-5" />

                  <small className="text-center">All Orders</small>
                </Paper>
              </Grid>
              <Grid item xs={6} sm={6} lg={3}>
                <Paper className="px-5 py-4 flex flex-col items-center">
                  <Skeleton variant="text" className="text-xl w-5" />

                  <small className="text-center">All Orders</small>
                </Paper>
              </Grid>
            </Grid>
          </Grid>
        </Grid>
      </div>
      <div>
        <Paper className="py-3 px-7 flex">
          <div className="flex flex-col p-2 flex-1">
            <small className="text-sm mb-1 text-color-gray">First Name</small>
            <Skeleton variant="text" />
          </div>
          <div className="flex flex-col p-2 flex-1">
            <small className="text-sm mb-1 text-color-gray">Last Name</small>
            <Skeleton variant="text" />
          </div>
          <div className="flex flex-col p-2 flex-1">
            <small className="text-sm mb-1 text-color-gray">Email</small>
            <Skeleton variant="text" />
          </div>
          <div className="flex flex-col p-2 flex-1">
            <small className="text-sm mb-1 text-color-gray">Phone</small>
            <Skeleton variant="text" />
          </div>
          <div className="flex flex-col p-2 flex-1">
            <small className="text-sm mb-1 text-color-gray">Birth date</small>
            <Skeleton variant="text" />
          </div>
        </Paper>
      </div>
    </div>
  );
};

export default InforLoading;
