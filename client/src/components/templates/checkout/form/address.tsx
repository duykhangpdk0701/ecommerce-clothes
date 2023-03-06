import React from "react";
import Paper from "@mui/material/Paper";
import Avatar from "@mui/material/Avatar";
import Button from "@mui/material/Button";
import Grid from "@mui/material/Grid";
import IconButton from "@mui/material/IconButton";

import EditIcon from "@mui/icons-material/Edit";
import DeleteOutlineIcon from "@mui/icons-material/DeleteOutline";

const CheckoutFormAddress = () => {
  return (
    <Paper className="mb-6 py-6 px-7" elevation={1}>
      <div className="flex items-center justify-between">
        <div className="flex mb-7 gap-3 items-center">
          <Avatar className="bg-color-price w-8 h-8">1</Avatar>
          <p className="text-xl">Delivery Address</p>
        </div>
        <Button size="small" variant="outlined" className="px-5">
          Add New Address
        </Button>
      </div>

      <p className="mb-3">Delivery Address</p>

      <Grid container spacing={3}>
        <Grid item xs={12} sm={6} md={4}>
          <Paper className="p-4 relative bg-color-light-gray">
            <div className="absolute top-[5px] right-[5px]">
              <IconButton size="small" className="mr-1">
                <EditIcon className="text-xl" />
              </IconButton>
              <IconButton size="small">
                <DeleteOutlineIcon className="text-xl text-color-price" />
              </IconButton>
            </div>
            <h6 className="mb-1 text-sm font-semibold">Home</h6>
            <p className="text-gray-600">375 Subidbazaar, MA 2351</p>
            <p className="text-gray-600">+17804084466</p>
          </Paper>
        </Grid>

        <Grid item xs={12} sm={6} md={4}>
          <Paper className="p-4 relative bg-color-light-gray">
            <div className="absolute top-[5px] right-[5px]">
              <IconButton size="small" className="mr-1">
                <EditIcon className="text-xl" />
              </IconButton>
              <IconButton size="small">
                <DeleteOutlineIcon className="text-xl text-color-price" />
              </IconButton>
            </div>
            <h6 className="mb-1 text-sm font-semibold">Home</h6>
            <p className="text-gray-600">375 Subidbazaar, MA 2351</p>
            <p className="text-gray-600">+17804084466</p>
          </Paper>
        </Grid>

        <Grid item xs={12} sm={6} md={4}>
          <Paper className="p-4 relative bg-color-light-gray">
            <div className="absolute top-[5px] right-[5px]">
              <IconButton size="small" className="mr-1">
                <EditIcon className="text-xl" />
              </IconButton>
              <IconButton size="small">
                <DeleteOutlineIcon className="text-xl text-color-price" />
              </IconButton>
            </div>
            <h6 className="mb-1 text-sm font-semibold">Home</h6>
            <p className="text-gray-600">375 Subidbazaar, MA 2351</p>
            <p className="text-gray-600">+17804084466</p>
          </Paper>
        </Grid>
      </Grid>
    </Paper>
  );
};

export default CheckoutFormAddress;
