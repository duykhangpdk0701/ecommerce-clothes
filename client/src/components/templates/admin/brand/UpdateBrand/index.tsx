import React, { FC } from "react";
//mui Component
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
import LoadingButton from "@mui/lab/LoadingButton";
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
import { IUpdateBrandParams } from "../../../../../../pages/admin/brand/[id]/update";
const ReactQuill = dynamic(() => import("react-quill"), { ssr: false });

interface IUpdateBrandTemplate {
  control: Control<IUpdateBrandParams, any>;
  handleSubmit: UseFormHandleSubmit<IUpdateBrandParams>;
  onSubmit: SubmitHandler<IUpdateBrandParams>;
  errors: FieldErrors<IUpdateBrandParams>;
  isLoading: boolean;
  errorResMessage: string;
}

const UpdateBrandTemplate: FC<IUpdateBrandTemplate> = (props) => {
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
            Update Brand
          </Typography>
          <Button
            LinkComponent={Link}
            variant="contained"
            startIcon={<Iconify icon="eva:plus-fill" />}
            href="/admin/brand"
          >
            Back to List Brand
          </Button>
        </Stack>
        <form onSubmit={handleSubmit(onSubmit)}>
          <Grid container spacing={3}>
            <Grid item xs={12} md={8}>
              <Paper className="p-6">
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
                    name="slug"
                    control={control}
                    render={({ field }) => (
                      <>
                        <TextField
                          disabled
                          error={errors.slug ? true : false}
                          {...field}
                          label="Slug"
                          fullWidth
                        />
                        <FormHelperText error={errors.slug ? true : false}>
                          {errors.slug?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Box>
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
                loading={isLoading}
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

export default UpdateBrandTemplate;
