import React, { FC } from "react";
import Paper from "@mui/material/Paper";
import Avatar from "@mui/material/Avatar";
import Button from "@mui/material/Button";
import Grid from "@mui/material/Grid";
import IconButton from "@mui/material/IconButton";

import EditIcon from "@mui/icons-material/Edit";
import DeleteOutlineIcon from "@mui/icons-material/DeleteOutline";
import IAddress from "@/interfaces/Address";
import { Control } from "react-hook-form/dist/types";
import { ICheckoutParams } from "@/pages/checkout";
import { Controller } from "react-hook-form";

interface ICheckoutFormAddress {
  data?: IAddress[];

  control: Control<ICheckoutParams, any>;
}

const CheckoutFormAddress: FC<ICheckoutFormAddress> = (props) => {
  const { data, control } = props;
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
        <Controller
          name="shipping"
          control={control}
          render={({ field: { onChange, value } }) => (
            <>
              {data?.map((item) => {
                const itemValue = {
                  id: item.id,
                  name: item.name,
                  cityId: item.city_id,
                  districtId: item.district_id,
                  wardId: item.ward_id,
                  address: item.address,
                  phone: item.phone,
                };

                const isChoose = value ? value.id === itemValue.id : false;

                return (
                  <Grid item xs={12} sm={6} md={4}>
                    <Paper
                      className={`p-4 relative bg-color-light-gray cursor-pointer`}
                      sx={isChoose ? { border: "red solid 1px" } : undefined}
                      onClick={() => onChange(itemValue)}
                    >
                      <div className="absolute top-[5px] right-[5px]">
                        <IconButton size="small" className="mr-1">
                          <EditIcon className="text-xl" />
                        </IconButton>
                        <IconButton size="small">
                          <DeleteOutlineIcon className="text-xl text-color-price" />
                        </IconButton>
                      </div>
                      <h6 className="mb-1 text-sm font-semibold">
                        {item.name}
                      </h6>
                      <p className="text-gray-600 whitespace-nowrap text-ellipsis overflow-hidden">
                        {item.address}, {item.parse_address_string}
                      </p>
                      <p className="text-gray-600">{item.phone}</p>
                    </Paper>
                  </Grid>
                );
              })}
            </>
          )}
        />
      </Grid>
    </Paper>
  );
};

export default CheckoutFormAddress;
