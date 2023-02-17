import {
  Box,
  Button,
  Container,
  FormControlLabel,
  FormHelperText,
  Grid,
  Paper,
  Stack,
  Switch,
  TextField,
  Typography,
} from "@mui/material";
import React, { ChangeEvent, FC, useState } from "react";
import Iconify from "@/components/shared/iconify";
import Link from "next/link";
import {
  Control,
  FieldErrors,
  SubmitHandler,
  UseFormHandleSubmit,
  Controller,
} from "react-hook-form";
import { IUpdateAdminParams } from "../../../../../../pages/admin/user/[id]/update";
import AddAPhotoIcon from "@mui/icons-material/AddAPhoto";
import { LazyLoadImage } from "react-lazy-load-image-component";

interface IUpdateUserAdminTemplate {
  control: Control<IUpdateAdminParams, any>;
  handleSubmit: UseFormHandleSubmit<IUpdateAdminParams>;
  onSubmit: SubmitHandler<IUpdateAdminParams>;
  errors: FieldErrors<IUpdateAdminParams>;
  isLoading: boolean;
  errorResMessage: string;
  handleSelectFile: (event: ChangeEvent<HTMLInputElement>) => void;
  file?: string;
}

const UpdateUserAdminTemplate: FC<IUpdateUserAdminTemplate> = (props) => {
  const {
    control,
    handleSubmit,
    onSubmit,
    errors,
    isLoading,
    errorResMessage,
    handleSelectFile,
    file,
  } = props;
  const [isVisible, setIsVisible] = useState(false);

  return (
    <main>
      <Container>
        <Stack
          direction="row"
          alignItems="center"
          justifyContent="space-between"
          mb={5}
        >
          <Typography variant="h4" gutterBottom>
            Update User
          </Typography>
          <Button
            LinkComponent={Link}
            variant="contained"
            startIcon={<Iconify icon="eva:plus-fill" />}
            href="/admin/user"
          >
            Back to List User
          </Button>
        </Stack>
        <form>
          <Grid container spacing={3}>
            <Grid item xs={12} md={4}>
              <Paper className="py-20">
                <div>
                  <Box
                    className="flex justify-center items-center w-36 h-36 mx-auto rounded-full relative"
                    sx={{ border: "1px dashed rgba(145, 158, 171, 0.32)" }}
                    component="label"
                    htmlFor="file-upload"
                  >
                    <input
                      type="file"
                      id="file-upload"
                      className="hidden"
                      tabIndex={-1}
                      onChange={handleSelectFile}
                      accept="image/jpg,.gif,.png,.jpeg"
                    />
                    <span className="overflow-hidden w-[calc(100%-16px)] h-[calc(100%-16px)] rounded-full z-[8] absolute">
                      <LazyLoadImage src={file} />
                    </span>
                    <div
                      className="w-[calc(100%-16px)] h-[calc(100%-16px)] rounded-full z-[9] absolute flex flex-col justify-center items-center transition-opacity"
                      style={{
                        backgroundColor: "rgba(22, 28, 36, 0.64)",
                        opacity: isVisible ? 1 : 0,
                      }}
                    >
                      <AddAPhotoIcon className="mb-2 text-white" />
                      <Typography variant="caption" color="white">
                        Update Photo
                      </Typography>
                    </div>
                    <div
                      className="w-full h-full rounded-full z-20 absolute opacity-0 cursor-pointer"
                      onMouseEnter={() => setIsVisible(true)}
                      onMouseOut={() => setIsVisible(false)}
                    ></div>
                  </Box>
                  <Typography
                    variant="caption"
                    className="block text-center mt-4"
                  >
                    Allowed *.jpeg, *.jpg, *.png, *.gif
                    <br /> max size of 3.1 MB
                  </Typography>
                </div>
                <div className="flex justify-center">
                  <FormControlLabel
                    className="mt-10"
                    value="start"
                    label="Active"
                    control={<Switch />}
                  />
                </div>
              </Paper>
            </Grid>
            <Grid item xs={12} md={8}>
              <Paper className="p-6">
                <Grid container rowSpacing={3} columnSpacing={2}>
                  <Grid item xs={12} md={6}>
                    <Controller
                      name="firstName"
                      control={control}
                      render={({ field }) => (
                        <>
                          <TextField
                            error={errors.firstName ? true : false}
                            {...field}
                            label="First Name"
                            fullWidth
                          />
                          <FormHelperText
                            error={errors.firstName ? true : false}
                          >
                            {errors.firstName?.message}
                          </FormHelperText>
                        </>
                      )}
                    />
                  </Grid>
                  <Grid item xs={12} md={6}>
                    <Controller
                      name="lastName"
                      control={control}
                      render={({ field }) => (
                        <>
                          <TextField
                            error={errors.firstName ? true : false}
                            {...field}
                            label="Last Name"
                            fullWidth
                          />
                          <FormHelperText
                            error={errors.firstName ? true : false}
                          >
                            {errors.firstName?.message}
                          </FormHelperText>
                        </>
                      )}
                    />
                  </Grid>
                  <Grid item xs={12} md={6}>
                    <Controller
                      name="email"
                      control={control}
                      render={({ field }) => (
                        <>
                          <TextField
                            error={errors.firstName ? true : false}
                            {...field}
                            label="Email"
                            fullWidth
                          />
                          <FormHelperText
                            error={errors.firstName ? true : false}
                          >
                            {errors.firstName?.message}
                          </FormHelperText>
                        </>
                      )}
                    />
                  </Grid>
                  <Grid item xs={12} md={6}>
                    <Controller
                      name="phone"
                      control={control}
                      render={({ field }) => (
                        <>
                          <TextField
                            error={errors.firstName ? true : false}
                            {...field}
                            label="Phone Number"
                            fullWidth
                          />
                          <FormHelperText
                            error={errors.firstName ? true : false}
                          >
                            {errors.firstName?.message}
                          </FormHelperText>
                        </>
                      )}
                    />
                  </Grid>
                  <Grid item xs={12} md={6}>
                    <Controller
                      name="role"
                      control={control}
                      render={({ field }) => (
                        <>
                          <TextField
                            error={errors.firstName ? true : false}
                            {...field}
                            label="Role"
                            fullWidth
                          />
                          <FormHelperText
                            error={errors.firstName ? true : false}
                          >
                            {errors.firstName?.message}
                          </FormHelperText>
                        </>
                      )}
                    />
                  </Grid>
                </Grid>
                <div className="flex justify-end">
                  <Button
                    className="mt-6"
                    disableElevation
                    type="submit"
                    variant="contained"
                  >
                    Save Changes
                  </Button>
                </div>
              </Paper>
            </Grid>
          </Grid>
        </form>
      </Container>
    </main>
  );
};

export default UpdateUserAdminTemplate;
