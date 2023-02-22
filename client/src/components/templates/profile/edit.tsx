import React, { FC } from "react";
//mui component
import PersonIcon from "@mui/icons-material/Person";
import Avatar from "@mui/material/Avatar";
import Button from "@mui/material/Button";
import Paper from "@mui/material/Paper";
import Grid from "@mui/material/Grid";
import LoadingButton from "@mui/lab/LoadingButton";
import TextField from "@mui/material/TextField";
import { DatePicker } from "@mui/x-date-pickers/DatePicker";
//netxt
import Link from "next/link";
import {
  Control,
  FieldErrors,
  SubmitHandler,
  UseFormHandleSubmit,
  Controller,
} from "react-hook-form";
import { IUpdateUserProfileParams } from "../../../../pages/profile/edit";
import FormHelperText from "@mui/material/FormHelperText";

interface IEditProfileTemplate {
  control: Control<IUpdateUserProfileParams, any>;
  handleSubmit: UseFormHandleSubmit<IUpdateUserProfileParams>;
  onSubmit: SubmitHandler<IUpdateUserProfileParams>;
  errors: FieldErrors<IUpdateUserProfileParams>;
  isLoading: boolean;
  errorResMessage: string;
}

const EditProfileTemplate: FC<IEditProfileTemplate> = (props) => {
  const {
    control,
    handleSubmit,
    onSubmit,
    errors,
    isLoading,
    errorResMessage,
  } = props;
  const [value, setValue] = React.useState(null);
  return (
    <div>
      <div className="mt-4 mb-6">
        <div className="flex gap-3 items-center justify-between">
          <div className="flex items-center">
            <PersonIcon className="text-2xl" />
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
          <form onSubmit={handleSubmit(onSubmit)}>
            <div className="mb-6">
              <Avatar className="h-16 w-16"> K</Avatar>
            </div>
            <div className="mb-8">
              <Grid container spacing={3}>
                <Grid item xs={12} md={6}>
                  <Controller
                    name="firstName"
                    control={control}
                    render={({ field, fieldState }) => (
                      <>
                        <TextField
                          error={fieldState.invalid}
                          {...field}
                          size="small"
                          label="First Name"
                          fullWidth
                        />
                        <FormHelperText error={fieldState.invalid}>
                          {fieldState.error?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Grid>
                <Grid item xs={12} md={6}>
                  <Controller
                    name="lastName"
                    control={control}
                    render={({ field, fieldState: { invalid, error } }) => (
                      <>
                        <TextField
                          error={invalid}
                          {...field}
                          size="small"
                          label="Last Name"
                          fullWidth
                        />
                        <FormHelperText error={invalid}>
                          {error?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Grid>
                <Grid item xs={12} md={6}>
                  <Controller
                    name="email"
                    control={control}
                    render={({ field, fieldState: { invalid, error } }) => (
                      <>
                        <TextField
                          error={invalid}
                          {...field}
                          size="small"
                          label="Email"
                          fullWidth
                        />
                        <FormHelperText error={invalid}>
                          {error?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Grid>
                <Grid item xs={12} md={6}>
                  <Controller
                    name="phone"
                    control={control}
                    render={({ field, fieldState: { invalid, error } }) => (
                      <>
                        <TextField
                          error={invalid}
                          {...field}
                          size="small"
                          label="Phone"
                          fullWidth
                        />
                        <FormHelperText error={invalid}>
                          {error?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Grid>
                <Grid item xs={12} md={6}>
                  <Controller
                    name="birthDate"
                    control={control}
                    render={({ field, fieldState: { invalid, error } }) => (
                      <>
                        <DatePicker
                          value={field.value}
                          onChange={field.onChange}
                          renderInput={(params) => (
                            <TextField
                              {...{ ...field, ...params }}
                              error={invalid}
                              size="small"
                              label="Birth Date"
                              fullWidth
                            />
                          )}
                        />
                        <FormHelperText error={invalid}>
                          {error?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Grid>
              </Grid>
            </div>
            <LoadingButton type="submit" variant="contained" disableElevation>
              Save Changes
            </LoadingButton>
          </form>
        </Paper>
      </div>
    </div>
  );
};

export default EditProfileTemplate;
