import { Button, Grid, Paper, TextField } from "@mui/material";
import React, { FC } from "react";
import { ICity } from "../../../../interfaces/Address";
import AutocompleteAsync from "../../../shared/AutocompleteAsync";

interface IAddAddressForm {
  cities?: ICity[];
  loading: boolean;
}

const AddAddressForm: FC<IAddAddressForm> = (props) => {
  const { cities, loading } = props;

  return (
    <Paper className="w-full py-6 px-7">
      <div>
        <div className="mb-8">
          <Grid container spacing={3}>
            <Grid item xs={6}>
              <TextField fullWidth label="Name" />
            </Grid>
            <Grid item xs={6}>
              <AutocompleteAsync fullWidth label="Ward" loading={false} />
            </Grid>
            <Grid item xs={6}>
              <TextField fullWidth label="Phone" />
            </Grid>
            <Grid item xs={6}>
              <AutocompleteAsync fullWidth label="District" loading={false} />
            </Grid>

            <Grid item xs={6}>
              <TextField fullWidth label="Address" />
            </Grid>
            <Grid item xs={6}>
              <AutocompleteAsync
                fullWidth
                label="City"
                data={cities}
                loading={loading}
              />
            </Grid>
          </Grid>
        </div>
        <Button variant="contained" disableElevation>
          Save Change
        </Button>
      </div>
    </Paper>
  );
};

export default AddAddressForm;
