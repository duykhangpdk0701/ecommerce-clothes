import React, { FC } from "react";

//mui component
import { MuiColorInput } from "mui-color-input";
import Container from "@mui/material/Container";
import Typography from "@mui/material/Typography";
import Stack from "@mui/material/Stack";
import Button from "@mui/material/Button";
import Grid from "@mui/material/Grid";
import Paper from "@mui/material/Paper";
import TextField from "@mui/material/TextField";
import Box from "@mui/material/Box";
import FormControlLabel from "@mui/material/FormControlLabel";
import Switch from "@mui/material/Switch";
import FormHelperText from "@mui/material/FormHelperText";
//icon
import Iconify from "@/components/shared/iconify";
import Link from "next/link";
import dynamic from "next/dynamic";
import {
  Control,
  FieldErrors,
  SubmitHandler,
  UseFormHandleSubmit,
  Controller,
} from "react-hook-form";
import { LoadingButton } from "@mui/lab";
import { ICreateItemColorParams } from "../../../../../../pages/admin/item-color/create";
const ReactQuill = dynamic(() => import("react-quill"), { ssr: false });

interface ICreateItemCategoryTemplate {
  control: Control<ICreateItemColorParams, any>;
  handleSubmit: UseFormHandleSubmit<ICreateItemColorParams>;
  onSubmit: SubmitHandler<ICreateItemColorParams>;
  errors: FieldErrors<ICreateItemColorParams>;
  isLoading: boolean;
  errorResMessage: string;
}

const CreateItemColorTemplate: FC<ICreateItemCategoryTemplate> = (props) => {
  const {
    control,
    handleSubmit,
    onSubmit,
    errors,
    isLoading,
    errorResMessage,
  } = props;

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
            Create Item Color
          </Typography>
          <Button
            LinkComponent={Link}
            variant="contained"
            startIcon={<Iconify icon="eva:plus-fill" />}
            href="/admin/item-color"
          >
            Back to List Item Color
          </Button>
        </Stack>
        <form onSubmit={handleSubmit(onSubmit)}>
          <Grid container spacing={3}>
            <Grid item xs={12} md={8}>
              <Paper className="p-6">
                <Box className="mb-6">
                  <Controller
                    name="name"
                    control={control}
                    render={({ field }) => (
                      <>
                        <TextField
                          error={errors.name ? true : false}
                          {...field}
                          label="Name"
                          fullWidth
                        />
                        <FormHelperText error={errors.name ? true : false}>
                          {errors.name?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Box>
                <Box>
                  <Controller
                    name="color"
                    control={control}
                    render={({ field }) => (
                      <>
                        <MuiColorInput
                          {...field}
                          error={errors.color ? true : false}
                          format="hex"
                          label="Color"
                          fullWidth
                        />
                        <FormHelperText error={errors.color ? true : false}>
                          {errors.color?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Box>
                <Box className="mt-6">
                  <Typography variant="h6">Description</Typography>
                  <ReactQuill placeholder="Write something about Brand" />
                </Box>
              </Paper>
            </Grid>
            <Grid item xs={12} md={4}>
              <Paper className="p-6">
                <Controller
                  name="status"
                  control={control}
                  render={({ field }) => (
                    <>
                      <FormControlLabel
                        control={<Switch {...field} defaultChecked />}
                        label="Status"
                      />
                      <FormHelperText error={errors.status ? true : false}>
                        {errors.status?.message}
                      </FormHelperText>
                    </>
                  )}
                />
                <Box className="mt-6">
                  <Controller
                    name="order"
                    control={control}
                    render={({ field }) => (
                      <>
                        <TextField
                          error={errors.order ? true : false}
                          {...field}
                          label="Order"
                          fullWidth
                        />
                        <FormHelperText error={errors.order ? true : false}>
                          {errors.order?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Box>
              </Paper>
              <LoadingButton
                className="mt-6"
                fullWidth
                variant="contained"
                size="large"
                type="submit"
              >
                Submit
              </LoadingButton>
            </Grid>
          </Grid>
        </form>
      </Container>
    </main>
  );
};

export default CreateItemColorTemplate;
