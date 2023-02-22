import React, { FC } from "react";

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
import FormControl from "@mui/material/FormControl";
import InputLabel from "@mui/material/InputLabel";
import { SelectChangeEvent } from "@mui/material/Select";
import MenuItem from "@mui/material/MenuItem";
import Select from "@mui/material/Select";
import FormLabel from "@mui/material/FormLabel";
import Radio from "@mui/material/Radio";
import RadioGroup from "@mui/material/RadioGroup";
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
import { IAdminProduct } from "interfaces/Product";
import { ICreateProductParams } from "../../../../../../pages/admin/product/create";
const ReactQuill = dynamic(() => import("react-quill"), { ssr: false });

interface ICreateProductTempalate {
  control: Control<ICreateProductParams, any>;
  handleSubmit: UseFormHandleSubmit<ICreateProductParams>;
  onSubmit: SubmitHandler<ICreateProductParams>;
  errors: FieldErrors<ICreateProductParams>;
  isLoading: boolean;
  errorResMessage: string;
  itemCategory?: IAdminProduct[];
}

const CreateProductTemplate: FC<ICreateProductTempalate> = (props) => {
  const {
    control,
    handleSubmit,
    onSubmit,
    errors,
    isLoading,
    errorResMessage,
    itemCategory,
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
            Create Item Size
          </Typography>
          <Button
            LinkComponent={Link}
            variant="contained"
            startIcon={<Iconify icon="eva:plus-fill" />}
            href="/admin/item-size"
          >
            Back to List Item Size
          </Button>
        </Stack>
        <form onSubmit={handleSubmit(onSubmit)}>
          <Grid container spacing={3}>
            <Grid item xs={12} md={8}>
              <Paper className="p-6">
                <Box className="mr-6">
                  <Controller
                    name="name"
                    control={control}
                    render={({ field, fieldState: { invalid, error } }) => (
                      <>
                        <TextField
                          error={invalid}
                          {...field}
                          label="Value"
                          fullWidth
                        />
                        <FormHelperText error={invalid}>
                          {error?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Box>

                <Box className="mt-6">
                  <Typography
                    variant="h6"
                    className="text-sm font-semibold text-color-gray"
                  >
                    Description
                  </Typography>
                  <ReactQuill
                    className="mt-1.5"
                    placeholder="Write something about Brand"
                  />
                </Box>
              </Paper>
            </Grid>
            <Grid item xs={12} md={4}>
              <Paper className="p-6">
                <Box className="mb-4">
                  <Controller
                    name="status"
                    control={control}
                    render={({ field, fieldState: { invalid, error } }) => (
                      <>
                        <FormControlLabel
                          control={<Switch {...field} defaultChecked />}
                          label="Status"
                        />
                        <FormHelperText error={invalid}>
                          {error?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Box>

                <Box className="mb-6">
                  <Controller
                    name="sku"
                    control={control}
                    render={({ field, fieldState: { invalid, error } }) => (
                      <>
                        <TextField
                          error={invalid}
                          {...field}
                          label="Product SKU"
                          fullWidth
                        />
                        <FormHelperText error={invalid}>
                          {error?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Box>

                <Box className="mb-6">
                  <Controller
                    name="itemPersonTypeId"
                    control={control}
                    render={({ field, fieldState: { invalid, error } }) => (
                      <FormControl
                        error={errors.itemPersonTypeId ? true : false}
                      >
                        <FormLabel className="text-sm font-semibold text-color-gray">
                          Gender
                        </FormLabel>
                        <RadioGroup
                          {...field}
                          row
                          aria-labelledby="demo-row-radio-buttons-group-label"
                          name="row-radio-buttons-group"
                        >
                          <FormControlLabel
                            value={1}
                            control={<Radio />}
                            label={<span className="text-sm">Men</span>}
                          />
                          <FormControlLabel
                            value={2}
                            control={<Radio />}
                            label={<span className="text-sm">Women</span>}
                          />
                          <FormControlLabel
                            value={3}
                            control={<Radio />}
                            label={<span className="text-sm">Kid</span>}
                          />
                        </RadioGroup>
                        <FormHelperText error={invalid}>
                          {error?.message}
                        </FormHelperText>
                      </FormControl>
                    )}
                  />
                </Box>

                <Box className="mb-6">
                  <Controller
                    name="itemCategoriesId"
                    control={control}
                    render={({ field, fieldState: { invalid, error } }) => (
                      <>
                        <TextField
                          error={invalid}
                          {...field}
                          label="Categories"
                          fullWidth
                        />
                        <FormHelperText error={invalid}>
                          {error?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Box>

                <Box>
                  <Controller
                    name="brandId"
                    control={control}
                    render={({ field, fieldState: { invalid, error } }) => (
                      <>
                        <FormControl fullWidth>
                          <InputLabel id="demo-simple-select-label">
                            Brand
                          </InputLabel>
                          <Select
                            error={invalid}
                            {...field}
                            labelId="demo-simple-select-label"
                            id="demo-simple-select"
                            label="Age"
                          ></Select>
                          <FormHelperText error={invalid}>
                            {error?.message}
                          </FormHelperText>
                        </FormControl>
                      </>
                    )}
                  />
                </Box>
              </Paper>

              <Paper className="p-6 mt-6" elevation={0}>
                <Box className="mb-6">
                  <Controller
                    name="itemSizes"
                    control={control}
                    render={({ field, fieldState: { invalid, error } }) => (
                      <>
                        <TextField
                          error={invalid}
                          {...field}
                          label="Prdouct Size"
                          fullWidth
                        />
                        <FormHelperText error={invalid}>
                          {error?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Box>

                <Box>
                  <Controller
                    name="itemColors"
                    control={control}
                    render={({ field, fieldState: { invalid, error } }) => (
                      <>
                        <TextField
                          error={invalid}
                          {...field}
                          label="Product Color"
                          fullWidth
                        />
                        <FormHelperText error={invalid}>
                          {error?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </Box>
              </Paper>

              <LoadingButton
                loading={isLoading}
                className="mt-6"
                fullWidth
                variant="contained"
                size="large"
                type="submit"
              >
                Create
              </LoadingButton>
            </Grid>
          </Grid>
        </form>
      </Container>
    </main>
  );
};

export default CreateProductTemplate;
