import { TEXT_COLOR_GRAY } from "@/styles/color";
import { Person } from "@mui/icons-material";
import { Button, Grid, Paper, Typography, Avatar } from "@mui/material";
import Link from "next/link";
import React from "react";

const ProfileTemplate = () => {
  return (
    <div>
      <div className="mt-4 mb-6">
        <div className="flex gap-3 items-center justify-between">
          <div className="flex items-center">
            <Person className="text-2xl" />
            <h2 className="text-2xl">My Profile</h2>
          </div>

          <div>
            <Button LinkComponent={Link} href={`/profile/${"id"}/edit`}>
              Edit Profile
            </Button>
          </div>
        </div>
      </div>

      <div className="mb-8">
        <Grid container spacing={3}>
          <Grid item md={6} xs={12}>
            <Paper className="py-3 px-8 h-full flex items-center">
              <Avatar className="h-16 w-16">K</Avatar>
              <div className="ml-3 flex-1">
                <div className="flex justify-start flex-col">
                  <h5 className="text-base">Reed Richart</h5>
                  <div className="flex">
                    <Typography
                      variant="body1"
                      style={{ color: TEXT_COLOR_GRAY }}
                    >
                      Balance:
                    </Typography>
                    <Typography variant="body1">100,000$</Typography>
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
            <small className="text-sm mb-1" style={{ color: TEXT_COLOR_GRAY }}>
              First Name
            </small>
            <span>Nick</span>
          </div>
          <div className="flex flex-col p-2 flex-1">
            <small className="text-sm mb-1" style={{ color: TEXT_COLOR_GRAY }}>
              Last Name
            </small>
            <span>Richard</span>
          </div>
          <div className="flex flex-col p-2 flex-1">
            <small className="text-sm mb-1" style={{ color: TEXT_COLOR_GRAY }}>
              Email
            </small>
            <span>duykhangpdk0701@gmail.com</span>
          </div>
          <div className="flex flex-col p-2 flex-1">
            <small className="text-sm mb-1" style={{ color: TEXT_COLOR_GRAY }}>
              Phone
            </small>
            <span>0793607376</span>
          </div>
          <div className="flex flex-col p-2 flex-1">
            <small className="text-sm mb-1" style={{ color: TEXT_COLOR_GRAY }}>
              Birth date
            </small>
            <span>31 july ,2001</span>
          </div>
        </Paper>
      </div>
    </div>
  );
};

export default ProfileTemplate;
