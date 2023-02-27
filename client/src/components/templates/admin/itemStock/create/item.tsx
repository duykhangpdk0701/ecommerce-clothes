import React, { FC, Fragment, useEffect, useMemo } from "react";
//mui component
import Button from "@mui/material/Button";
import Grid from "@mui/material/Grid";
import Paper from "@mui/material/Paper";
import TextField from "@mui/material/TextField";
import Box from "@mui/material/Box";
import FormHelperText from "@mui/material/FormHelperText";
import Autocomplete from "@mui/material/Autocomplete";
import Select from "@mui/material/Select";
import FormControl from "@mui/material/FormControl";
import InputLabel from "@mui/material/InputLabel";
import MenuItem from "@mui/material/MenuItem";

import { Control, Controller, UseFieldArrayRemove } from "react-hook-form";
import { ICreateItemStockParams } from "@/pages/admin/item-stock/create";
import { useQuery } from "react-query";
import adminItemAPI from "@/api/admin/adminItemAPI";
import adminItemVariantAPI from "@/api/admin/adminItemVariant";
import { LazyLoadImage } from "react-lazy-load-image-component";
import { UseFormGetValues } from "react-hook-form/dist/types";

interface ICreateItemStockItem {
  index: number;
  control: Control<ICreateItemStockParams, any>;
  remove: UseFieldArrayRemove;
  getValues: UseFormGetValues<ICreateItemStockParams>;
}

const CreateItemStockItem: FC<ICreateItemStockItem> = (props) => {
  const { control, index, remove, getValues } = props;

  const itemQuery = useQuery({
    queryKey: "item",
    queryFn: () => adminItemAPI.getListOfItem(),
  });

  const itemVariantQuery = useQuery({
    queryKey: ["item-detail", getValues(`itemInBound.${index}.itemId` as any)],
    queryFn: () => {
      if (getValues(`itemInBound.${index}.itemId` as any)) {
        return adminItemVariantAPI.getListOfItemVarinatByItemId(
          getValues(`itemInBound.${index}.itemId` as any)
        );
      }
      return undefined;
    },
  });

  return (
    <Fragment>
      <Grid item xs={12} md={8}>
        <Paper className="p-6">
          <Box className="mb-6">
            <Controller
              control={control}
              name={`itemInBound[${index}].itemId` as any}
              render={({ field, fieldState: { invalid, error } }) => (
                <>
                  <FormControl fullWidth error={invalid}>
                    <InputLabel>Item</InputLabel>
                    <Select {...field}>
                      {itemQuery.data?.map((item) => (
                        <MenuItem value={item.id} key={item.id}>
                          <div className="flex gap-3 items-center">
                            <div className="w-7 h-7">
                              <LazyLoadImage src={item.thumbnail_url} />
                            </div>
                            <div>{item.name}</div>
                          </div>
                        </MenuItem>
                      ))}
                    </Select>
                  </FormControl>
                </>
              )}
            />
          </Box>
          <Box className="mb-6">
            <Controller
              control={control}
              name={`itemInBound[${index}].itemVariantId` as any}
              render={({ field, fieldState: { invalid, error } }) => (
                <>
                  <FormControl
                    disabled={itemVariantQuery.isRefetching}
                    fullWidth
                    error={invalid}
                  >
                    <InputLabel>Item</InputLabel>
                    <Select {...field}>
                      {itemVariantQuery.data?.map((item) => (
                        <MenuItem value={item.id} key={item.id}>
                          <div className="flex gap-1 items-center">
                            <div>Size: {item.size.value},</div>
                            <div>Color: {item.color.name}</div>
                          </div>
                        </MenuItem>
                      ))}
                    </Select>
                  </FormControl>
                </>
              )}
            />
          </Box>
          <Box>
            <Button
              onClick={() => remove(index)}
              fullWidth
              variant="outlined"
              color="error"
            >
              Remove This Field
            </Button>
          </Box>
        </Paper>
      </Grid>
      <Grid item xs={12} md={4}>
        <Paper className="p-6">
          <Box className="mb-6">
            <Controller
              control={control}
              name={`itemInBound[${index}].priceIn` as any}
              render={({ field, fieldState: { invalid, error } }) => (
                <TextField
                  {...field}
                  error={invalid}
                  helperText={error?.message}
                  fullWidth
                  label={`Price In - ${index + 1}`}
                />
              )}
            />
          </Box>
          <Box className="mb-6">
            <Controller
              name={`itemInBound[${index}].price` as any}
              control={control}
              render={({ field, fieldState: { invalid, error } }) => (
                <>
                  <TextField
                    error={invalid}
                    {...field}
                    label={`Price - ${index + 1}`}
                    fullWidth
                    type="number"
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
              name={`itemInBound[${index}].quantity` as any}
              control={control}
              render={({ field, fieldState: { invalid, error } }) => (
                <>
                  <TextField
                    error={invalid}
                    {...field}
                    label={`Quantity - ${index + 1}`}
                    type="number"
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
      </Grid>
    </Fragment>
  );
};

export default CreateItemStockItem;
