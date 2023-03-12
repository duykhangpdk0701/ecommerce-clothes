import React, { FC, Fragment } from "react";
//mui component
import Container from "@mui/material/Container";
import Typography from "@mui/material/Typography";
import Stack from "@mui/material/Stack";
import Button from "@mui/material/Button";
import Grid from "@mui/material/Grid";

//icon
import Iconify from "@/components/shared/iconify";
import Link from "next/link";
import {
  Control,
  FieldErrors,
  SubmitHandler,
  UseFormHandleSubmit,
  FieldArrayWithId,
  UseFieldArrayAppend,
  UseFieldArrayRemove,
  UseFormSetValue,
} from "react-hook-form";
import { LoadingButton } from "@mui/lab";
import { ICreateItemStockParams } from "@/pages/admin/item-stock/create";
import CreateItemStockItem from "./item";
import { UseFormGetValues, UseFormWatch } from "react-hook-form/dist/types";

interface ICreateItemCategoryTemplate {
  fields: FieldArrayWithId<ICreateItemStockParams, "itemInBound", "id">[];
  append: UseFieldArrayAppend<ICreateItemStockParams, "itemInBound">;
  remove: UseFieldArrayRemove;
  control: Control<ICreateItemStockParams, any>;
  handleSubmit: UseFormHandleSubmit<ICreateItemStockParams>;
  onSubmit: SubmitHandler<ICreateItemStockParams>;
  errors: FieldErrors<ICreateItemStockParams>;
  isLoading: boolean;
  errorResMessage: string;
  getValues: UseFormGetValues<ICreateItemStockParams>;
  watch: UseFormWatch<ICreateItemStockParams>;
  setValue: UseFormSetValue<ICreateItemStockParams>;
}

const CreateItemStockTemplate: FC<ICreateItemCategoryTemplate> = (props) => {
  const {
    fields,
    append,
    remove,
    control,
    handleSubmit,
    onSubmit,
    errors,
    isLoading,
    errorResMessage,
    getValues,
    watch,
    setValue,
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
            Add Item Stock
          </Typography>
          <Button
            LinkComponent={Link}
            variant="contained"
            startIcon={<Iconify icon="eva:plus-fill" />}
            href="/admin/item-stock"
          >
            Back to List Item Stock
          </Button>
        </Stack>
        <form onSubmit={handleSubmit(onSubmit)}>
          <Grid container spacing={3}>
            {fields.map(({ id }, index) => (
              <CreateItemStockItem
                getValues={getValues}
                control={control}
                index={index}
                key={id}
                remove={remove}
                watch={watch}
                setValue={setValue}
              />
            ))}
            <Grid item xs={12} md={8}>
              <Button
                fullWidth
                variant="outlined"
                size="large"
                onClick={() => {
                  append({
                    itemId: 1,
                    itemVariantId: 1,
                    priceIn: 100000,
                    price: 200000,
                    stockStatusId: 1,
                    quantity: 1,
                  });
                }}
              >
                Add More field
              </Button>
            </Grid>
            <Grid item xs={12} md={4}>
              <LoadingButton
                loading={isLoading}
                size="large"
                fullWidth
                variant="contained"
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

export default CreateItemStockTemplate;
