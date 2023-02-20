import React, { FC } from "react";

//mui component
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
import { ICreateItemSizeParams } from "../../../../../../pages/admin/item-size/create";
import ICategory from "interfaces/Category";
const ReactQuill = dynamic(() => import("react-quill"), { ssr: false });

interface ICreateItemSizeTemplate {
  control: Control<ICreateItemSizeParams, any>;
  handleSubmit: UseFormHandleSubmit<ICreateItemSizeParams>;
  onSubmit: SubmitHandler<ICreateItemSizeParams>;
  errors: FieldErrors<ICreateItemSizeParams>;
  isLoading: boolean;
  errorResMessage: string;
  itemCategory?: ICategory[];
}

const CreateItemSizeTemplate: FC<ICreateItemSizeTemplate> = (props) => {
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
                    name="value"
                    control={control}
                    render={({ field }) => (
                      <>
                        <TextField
                          error={errors.order ? true : false}
                          {...field}
                          label="Value"
                          fullWidth
                        />
                        <FormHelperText error={errors.order ? true : false}>
                          {errors.order?.message}
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
                <Box className="my-6">
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
                <Box className="mb-6">
                  <Controller
                    name="itemPersonTypeId"
                    control={control}
                    render={({ field }) => (
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
                        <FormHelperText
                          error={errors.itemPersonTypeId ? true : false}
                        >
                          {errors.itemPersonTypeId?.message}
                        </FormHelperText>
                      </FormControl>
                    )}
                  />
                </Box>

                <Box>
                  <Controller
                    name="itemCategoryId"
                    control={control}
                    render={({ field }) => (
                      <>
                        <FormControl fullWidth>
                          <InputLabel id="demo-simple-select-label">
                            Age
                          </InputLabel>
                          <Select
                            error={errors.itemCategoryId ? true : false}
                            {...field}
                            labelId="demo-simple-select-label"
                            id="demo-simple-select"
                            label="Age"
                          >
                            {itemCategory?.map((item) => (
                              <MenuItem value={item.id}>
                                {item.name.en}
                              </MenuItem>
                            ))}
                          </Select>
                          <FormHelperText
                            error={errors.itemCategoryId ? true : false}
                          >
                            {errors.itemCategoryId?.message}
                          </FormHelperText>
                        </FormControl>
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

export default CreateItemSizeTemplate;
