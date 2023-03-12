import IUser from "@/interfaces/User";
import React, { FC } from "react";
import Grid from "@mui/material/Grid";
import Paper from "@mui/material/Paper";
import Typography from "@mui/material/Typography";
import Avatar from "@mui/material/Avatar";

interface IProfileInfo {
  data?: IUser;
}

const ProfileInfo: FC<IProfileInfo> = (props) => {
  const { data } = props;

  return (
    <div>
      <div className="mb-8">
        <Grid container spacing={3}>
          <Grid item md={6} xs={12}>
            <Paper className="py-3 px-8 h-full flex items-center">
              <Avatar className="h-16 w-16" src={data?.avatar} />
              <div className="ml-3 flex-1">
                <div className="flex justify-start flex-col">
                  <h5 className="text-base">{data?.name}</h5>
                  <div className="flex">
                    <Typography className="text-color-gray" variant="body1">
                      {data?.role}
                    </Typography>
                  </div>
                </div>
              </div>
            </Paper>
          </Grid>
          <Grid item md={6} xs={12}>
            <Grid container spacing={4}>
              <Grid item xs={6} sm={6} lg={3}>
                <Paper className="px-5 py-4 flex flex-col items-center">
                  <Typography variant="h3" className="text-xl">
                    16
                  </Typography>
                  <small className="text-center">All Orders</small>
                </Paper>
              </Grid>
              <Grid item xs={6} sm={6} lg={3}>
                <Paper className="px-5 py-4 flex flex-col items-center">
                  <Typography variant="h3" className="text-xl">
                    16
                  </Typography>
                  <small className="text-center">All Orders</small>
                </Paper>
              </Grid>
              <Grid item xs={6} sm={6} lg={3}>
                <Paper className="px-5 py-4 flex flex-col items-center">
                  <Typography variant="h3" className="text-xl">
                    16
                  </Typography>
                  <small className="text-center">All Orders</small>
                </Paper>
              </Grid>
              <Grid item xs={6} sm={6} lg={3}>
                <Paper className="px-5 py-4 flex flex-col items-center">
                  <Typography variant="h3" className="text-xl">
                    16
                  </Typography>
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
            <span>{data?.profile.first_name}</span>
          </div>
          <div className="flex flex-col p-2 flex-1">
            <small className="text-sm mb-1 text-color-gray">Last Name</small>
            <span>{data?.profile.last_name}</span>
          </div>
          <div className="flex flex-col p-2 flex-1">
            <small className="text-sm mb-1 text-color-gray">Email</small>
            <span>{data?.email}</span>
          </div>
          <div className="flex flex-col p-2 flex-1">
            <small className="text-sm mb-1 text-color-gray">Phone</small>
            <span>{data?.profile.phone}</span>
          </div>
          <div className="flex flex-col p-2 flex-1">
            <small className="text-sm mb-1 text-color-gray">Birth date</small>
            <span>31 july ,2001</span>
          </div>
        </Paper>
      </div>
    </div>
  );
};

export default ProfileInfo;
