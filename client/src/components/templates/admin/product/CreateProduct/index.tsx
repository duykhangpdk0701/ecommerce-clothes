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
import MenuItem from "@mui/material/MenuItem";
import Select from "@mui/material/Select";
import FormLabel from "@mui/material/FormLabel";
import Radio from "@mui/material/Radio";
import RadioGroup from "@mui/material/RadioGroup";
import OutlinedInput from "@mui/material/OutlinedInput";
import Chip from "@mui/material/Chip";
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
import { IAdminProduct } from "@/interfaces/Product";
import { ICreateProductParams } from "../../../../../../pages/admin/product/create";
import { IAdminCategory } from "@/interfaces/Category";
import { IAdminBrand } from "@/interfaces/Brand";
import { IAdminColor } from "@/interfaces/Color";
import { IAdminItemSize } from "@/interfaces/ItemSize";
import Dropzone from "@/components/shared/dropzone";

const ReactQuill = dynamic(() => import("react-quill"), { ssr: false });

interface ICreateProductTempalate {
  control: Control<ICreateProductParams, any>;
  handleSubmit: UseFormHandleSubmit<ICreateProductParams>;
  onSubmit: SubmitHandler<ICreateProductParams>;
  errors: FieldErrors<ICreateProductParams>;
  isLoading: boolean;
  errorResMessage: string;
  products?: IAdminProduct[];
  itemCategroies?: IAdminCategory[];
  brand?: IAdminBrand[];
  itemColor?: IAdminColor[];
  itemSize?: IAdminItemSize[];
}

const CreateProductTemplate: FC<ICreateProductTempalate> = (props) => {
  const {
    control,
    handleSubmit,
    onSubmit,
    errors,
    isLoading,
    errorResMessage,
    products,
    itemCategroies,
    brand,
    itemColor,
    itemSize,
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
            Create Item
          </Typography>
          <Button
            LinkComponent={Link}
            variant="contained"
            startIcon={<Iconify icon="eva:plus-fill" />}
            href="/admin/item-size"
          >
            Back to List Item
          </Button>
        </Stack>
        <form onSubmit={handleSubmit(onSubmit)}>
          <Grid container spacing={3}>
            <Grid item xs={12} md={8}>
              <Paper className="p-6">
                <Box>
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
                  <div className="mt-1">
                    <Controller
                      name="description"
                      control={control}
                      render={({ field, fieldState: { invalid, error } }) => (
                        <>
                          <ReactQuill
                            {...field}
                            className="mt-1.5 min-h-[200px]"
                            placeholder="Write something about Brand"
                          />
                          <FormHelperText error={invalid}>
                            {error?.message}
                          </FormHelperText>
                        </>
                      )}
                    />
                  </div>
                </Box>
                <Box className="mt-6">
                  <Typography
                    variant="h6"
                    className="text-sm font-semibold text-color-gray"
                  >
                    Thumbnail Image
                  </Typography>
                  <div className="mt-2">
                    <Controller
                      name="thumbnailImage"
                      control={control}
                      render={({ field, fieldState: { invalid, error } }) => (
                        <>
                          <Dropzone
                            error={invalid}
                            onChange={field.onChange}
                            multiple={false}
                          />
                          <FormHelperText error={invalid}>
                            {error?.message}
                          </FormHelperText>
                        </>
                      )}
                    />
                  </div>
                </Box>

                <Box className="mt-6">
                  <Typography
                    variant="h6"
                    className="text-sm font-semibold text-color-gray"
                  >
                    Decription Image
                  </Typography>
                  <div className="mt-2">
                    <Controller
                      name="detailImages"
                      control={control}
                      render={({ field, fieldState: { invalid, error } }) => (
                        <>
                          <Dropzone
                            onChange={field.onChange}
                            multiple={true}
                            error={invalid}
                          />
                          <FormHelperText error={invalid}>
                            {error?.message}
                          </FormHelperText>
                        </>
                      )}
                    />
                  </div>
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
                        <RadioGroup {...field} row>
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
                        <FormControl fullWidth error={invalid}>
                          <InputLabel id="demo-multiple-chip-label">
                            Categories
                          </InputLabel>
                          <Select
                            value={field.value}
                            onChange={field.onChange}
                            multiple
                            fullWidth
                            input={
                              <OutlinedInput
                                fullWidth
                                id="select-multiple-chip"
                                label="Chip"
                              />
                            }
                            renderValue={(selected) => (
                              <Box
                                sx={{
                                  display: "flex",
                                  flexWrap: "wrap",
                                  gap: 0.5,
                                }}
                              >
                                {selected?.map((value) => {
                                  const temp = itemCategroies?.find(
                                    (item) => item.id === value
                                  );
                                  return (
                                    <Chip
                                      key={value}
                                      label={<span>{temp?.name.en}</span>}
                                    />
                                  );
                                })}
                              </Box>
                            )}
                          >
                            {itemCategroies?.map((value) => (
                              <MenuItem key={value.id} value={value.id}>
                                {value.name.en}
                              </MenuItem>
                            ))}
                          </Select>
                        </FormControl>
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
                        <FormControl fullWidth error={invalid}>
                          <InputLabel id="demo-simple-select-label">
                            Brand
                          </InputLabel>
                          <Select
                            {...field}
                            labelId="demo-simple-select-label"
                            id="demo-simple-select"
                            label="Age"
                          >
                            {brand?.map((value) => (
                              <MenuItem key={value.id} value={value.id}>
                                {value.name}
                              </MenuItem>
                            ))}
                          </Select>
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
                        <FormControl fullWidth error={invalid}>
                          <InputLabel id="demo-multiple-chip-label">
                            Product Size
                          </InputLabel>
                          <Select
                            value={field.value}
                            onChange={field.onChange}
                            multiple
                            fullWidth
                            input={
                              <OutlinedInput
                                fullWidth
                                id="select-multiple-chip"
                                label="Chip"
                              />
                            }
                            renderValue={(selected) => (
                              <Box
                                sx={{
                                  display: "flex",
                                  flexWrap: "wrap",
                                  gap: 0.5,
                                }}
                              >
                                {selected?.map((value) => {
                                  const temp = itemSize?.find(
                                    (item) => item.id === value
                                  );
                                  return (
                                    <Chip
                                      key={value}
                                      label={<span>{temp?.value}</span>}
                                    />
                                  );
                                })}
                              </Box>
                            )}
                          >
                            {itemSize?.map((value) => (
                              <MenuItem key={value.id} value={value.id}>
                                {value.value}
                              </MenuItem>
                            ))}
                          </Select>
                        </FormControl>
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
                        <FormControl fullWidth error={invalid}>
                          <InputLabel id="demo-multiple-chip-label">
                            Product Color
                          </InputLabel>
                          <Select
                            value={field.value}
                            onChange={field.onChange}
                            multiple
                            fullWidth
                            input={
                              <OutlinedInput
                                fullWidth
                                id="select-multiple-chip"
                                label="Chip"
                              />
                            }
                            renderValue={(selected) => (
                              <Box
                                sx={{
                                  display: "flex",
                                  flexWrap: "wrap",
                                  gap: 0.5,
                                }}
                              >
                                {selected?.map((value) => {
                                  const temp = itemColor?.find(
                                    (item) => item.id === value
                                  );
                                  return (
                                    <Chip
                                      key={value}
                                      label={<span>{temp?.name}</span>}
                                    />
                                  );
                                })}
                              </Box>
                            )}
                          >
                            {itemColor?.map((value) => (
                              <MenuItem key={value.id} value={value.id}>
                                {value.name}
                              </MenuItem>
                            ))}
                          </Select>
                        </FormControl>
                        <FormHelperText className="mt-2 mx-3" error={invalid}>
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
