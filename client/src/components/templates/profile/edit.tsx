import React from "react";
import { Person } from "@mui/icons-material";
import Link from "next/link";
import { Avatar, Button, Paper, Grid, TextField } from "@mui/material";
import { DatePicker } from "@mui/x-date-pickers/DatePicker";

const EditProfileTemplate = () => {
  const [value, setValue] = React.useState(null);
  return (
    <div>
      <div className="mt-4 mb-6">
        <div className="flex gap-3 items-center justify-between">
          <div className="flex items-center">
            <Person className="text-2xl" />
            <h2 className="text-2xl">Edit Profile</h2>
          </div>

          <div>
            <Button LinkComponent={Link} href={`/profile`}>
              Back To Profile
            </Button>
          </div>
        </div>
      </div>
      <div>
        <Paper className="py-6 px-7">
          <form>
            <div className="mb-6">
              <Avatar className="h-16 w-16"> K</Avatar>
            </div>
            <div className="mb-8">
              <Grid container spacing={3}>
                <Grid item xs={12} md={6}>
                  <TextField size="small" label="First Name" fullWidth />
                </Grid>
                <Grid item xs={12} md={6}>
                  <TextField size="small" label="Last Name" fullWidth />
                </Grid>{" "}
                <Grid item xs={12} md={6}>
                  <TextField
                    size="small"
                    label="Email"
                    type="email"
                    fullWidth
                  />
                </Grid>
                <Grid item xs={12} md={6}>
                  <TextField size="small" label="Phone" fullWidth />
                </Grid>
                <Grid item xs={12} md={6}>
                  <DatePicker
                    value={value}
                    onChange={(newValue) => {
                      setValue(newValue);
                    }}
                    renderInput={(params) => (
                      <TextField
                        {...params}
                        size="small"
                        label="Birth Date"
                        fullWidth
                      />
                    )}
                  />
                </Grid>
              </Grid>
            </div>
            <Button variant="contained" disableElevation>
              Save Changes
            </Button>
          </form>
        </Paper>
      </div>
    </div>
  );
};

export default EditProfileTemplate;
