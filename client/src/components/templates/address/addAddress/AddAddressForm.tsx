import Button from "@mui/material/Button";
import Grid from "@mui/material/Grid";
import Paper from "@mui/material/Paper";
import TextField from "@mui/material/TextField";
import React, { FC } from "react";
import { ICity, IDistrict, IWard } from "@/interfaces/Address";
import AutocompleteAsync from "@/components/shared/AutocompleteAsync";
import { Controller } from "react-hook-form";
import {
  Control,
  SubmitHandler,
  UseFormHandleSubmit,
} from "react-hook-form/dist/types";
import { IAddressParams } from "@/pages/address/add";

interface IAddAddressForm {
  control: Control<IAddressParams, any>;
  handleSubmit: UseFormHandleSubmit<IAddressParams>;
  onSubmit: SubmitHandler<IAddressParams>;

  cities?: ICity[];
  isLoadingCity: boolean;
  district?: IDistrict[];
  isLoadingDistrict: boolean;
  ward?: IWard[];
  isLoadingWard: boolean;
}

const AddAddressForm: FC<IAddAddressForm> = (props) => {
  const {
    control,
    handleSubmit,
    onSubmit,
    cities,
    district,
    ward,
    isLoadingCity,
    isLoadingDistrict,
    isLoadingWard,
  } = props;

  return (
    <Paper className="w-full py-6 px-7">
      <form onSubmit={handleSubmit(onSubmit)}>
        <div className="mb-8">
          <Grid container spacing={3}>
            <Grid item md={6} xs={12}>
              <Controller
                name="name"
                control={control}
                render={({ field }) => (
                  <TextField {...field} fullWidth label="Name" />
                )}
              />
            </Grid>
            <Grid item md={6} xs={12}>
              <Controller
                name="ward"
                control={control}
                render={({ field }) => (
                  <AutocompleteAsync
                    autoComplete="off"
                    onChange={field.onChange}
                    data={ward}
                    fullWidth
                    label="Ward"
                    loading={isLoadingWard}
                    formValue={field.value}
                  />
                )}
              />
            </Grid>
            <Grid item md={6} xs={12}>
              <Controller
                name="phone"
                control={control}
                render={({ field }) => (
                  <TextField {...field} fullWidth label="Phone" />
                )}
              />
            </Grid>
            <Grid item md={6} xs={12}>
              <Controller
                name="district"
                control={control}
                render={({ field }) => (
                  <AutocompleteAsync
                    autoComplete="off"
                    onChange={field.onChange}
                    data={district}
                    fullWidth
                    label="District"
                    loading={isLoadingDistrict}
                    formValue={field.value}
                  />
                )}
              />
            </Grid>

            <Grid item md={6} xs={12}>
              <Controller
                name="address"
                control={control}
                render={({ field }) => (
                  <TextField {...field} fullWidth label="Address" />
                )}
              />
            </Grid>
            <Grid item md={6} xs={12}>
              <Controller
                name="city"
                control={control}
                render={({ field }) => (
                  <AutocompleteAsync
                    autoComplete="off"
                    onChange={field.onChange}
                    fullWidth
                    label="City"
                    data={cities}
                    loading={isLoadingCity}
                    formValue={field.value}
                  />
                )}
              />
            </Grid>
          </Grid>
        </div>
        <Button type="submit" variant="contained" disableElevation>
          Save Change
        </Button>
      </form>
    </Paper>
  );
};

export default AddAddressForm;
