import React, { FC, Fragment, useEffect, useMemo } from "react";
//mui component
import Button from "@mui/material/Button";
import Grid from "@mui/material/Grid";
import Paper from "@mui/material/Paper";
import TextField from "@mui/material/TextField";
import Box from "@mui/material/Box";
import FormHelperText from "@mui/material/FormHelperText";
import Autocomplete from "@mui/material/Autocomplete";
import CircularProgress from "@mui/material/CircularProgress";

import {
  Control,
  Controller,
  UseFieldArrayRemove,
  UseFormSetValue,
} from "react-hook-form";
import { ICreateItemStockParams } from "@/pages/admin/item-stock/create";
import { useQuery } from "react-query";
import adminItemAPI from "@/api/admin/adminItemAPI";
import adminItemVariantAPI from "@/api/admin/adminItemVariant";
import { LazyLoadImage } from "react-lazy-load-image-component";
import { UseFormGetValues, UseFormWatch } from "react-hook-form/dist/types";

interface ICreateItemStockItem {
  index: number;
  control: Control<ICreateItemStockParams, any>;
  remove: UseFieldArrayRemove;
  getValues: UseFormGetValues<ICreateItemStockParams>;
  watch: UseFormWatch<ICreateItemStockParams>;
  setValue: UseFormSetValue<ICreateItemStockParams>;
}

const CreateItemStockItem: FC<ICreateItemStockItem> = (props) => {
  const { control, index, remove, getValues, watch, setValue } = props;

  const itemQuery = useQuery({
    queryKey: "item",
    queryFn: () => adminItemAPI.getListOfItem(),
  });

  const itemVariantQuery = useQuery({
    queryKey: [
      "item-detail",
      watch(`itemInBound.${index}.itemId` as "itemInBound.0.itemId"),
    ],
    queryFn: () => {
      if (getValues(`itemInBound.${index}.itemId` as "itemInBound.0.itemId")) {
        return adminItemVariantAPI.getListOfItemVarinatByItemId(
          getValues(`itemInBound.${index}.itemId` as "itemInBound.0.itemId")
        );
      }
      return undefined;
    },
  });

  useEffect(() => {
    setValue(`itemInBound[${index}].itemVariantId` as any, undefined);
  }, [watch(`itemInBound.${index}.itemId` as "itemInBound.0.itemId")]);

  return (
    <Fragment>
      <Grid item xs={12} md={8}>
        <Paper className="p-6">
          <Box className="mb-6">
            <Controller
              control={control}
              name={`itemInBound.${index}.itemId` as "itemInBound.0.itemId"}
              render={({
                field: { value, onChange },
                fieldState: { invalid, error },
              }) => (
                <>
                  <Autocomplete
                    value={itemQuery.data?.find((item) => item.id == value)}
                    onChange={(e, value) => onChange(value?.id)}
                    disabled={itemQuery.isLoading}
                    isOptionEqualToValue={(option, value) =>
                      option.id == value.id || !value
                    }
                    getOptionLabel={(option) =>
                      option.name ? option.name : ""
                    }
                    options={
                      itemQuery.data?.map((item) => ({
                        id: item.id,
                        name: item.name,
                        thumbnail_url: item.thumbnail_url,
                      })) || []
                    }
                    renderOption={(props, option) => (
                      <Box
                        component="li"
                        className="flex gap-3 items-center"
                        {...props}
                      >
                        <div className="w-7 h-7">
                          <LazyLoadImage src={option.thumbnail_url} />
                        </div>
                        <div>{option.name}</div>
                      </Box>
                    )}
                    renderInput={(params) => (
                      <>
                        <TextField
                          label="Item"
                          error={invalid}
                          {...params}
                          InputProps={{
                            ...params.InputProps,
                            endAdornment: (
                              <React.Fragment>
                                {itemQuery.isLoading ? (
                                  <CircularProgress color="inherit" size={20} />
                                ) : null}
                                {params.InputProps.endAdornment}
                              </React.Fragment>
                            ),
                          }}
                        />
                        <FormHelperText error={invalid}>
                          {error?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
                </>
              )}
            />
          </Box>
          <Box className="mb-6">
            <Controller
              control={control}
              name={
                `itemInBound[${index}].itemVariantId` as "itemInBound.0.itemVariantId"
              }
              render={({
                field: { value, onChange },
                fieldState: { invalid, error },
              }) => (
                <>
                  <Autocomplete
                    value={itemVariantQuery.data
                      ?.map((item) => ({
                        id: item.id,
                        color: item.color.name,
                        size: item.size.value,
                      }))
                      ?.find((item) => item.id === value)}
                    onChange={(e, value) => onChange(value?.id)}
                    disabled={itemQuery.isLoading}
                    isOptionEqualToValue={(option, value) =>
                      option.id == value.id || !value
                    }
                    getOptionLabel={(option) =>
                      option.id ? `${option.color}, ${option.size}` : ""
                    }
                    options={
                      itemVariantQuery.data?.map((item) => ({
                        id: item.id,
                        size: item.size.value,
                        color: item.color.name,
                      })) || []
                    }
                    renderOption={(props, option) => (
                      <Box
                        component="li"
                        className="flex gap-3 items-center"
                        {...props}
                      >
                        <div>
                          {option.color}, {option.size}
                        </div>
                      </Box>
                    )}
                    renderInput={(params) => (
                      <>
                        <TextField
                          error={invalid}
                          label="Item Variant"
                          {...params}
                          InputProps={{
                            ...params.InputProps,
                            endAdornment: (
                              <React.Fragment>
                                {itemQuery.isLoading ? (
                                  <CircularProgress color="inherit" size={20} />
                                ) : null}
                                {params.InputProps.endAdornment}
                              </React.Fragment>
                            ),
                          }}
                        />
                        <FormHelperText error={invalid}>
                          {error?.message}
                        </FormHelperText>
                      </>
                    )}
                  />
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
                <>
                  <TextField
                    {...field}
                    error={invalid}
                    helperText={error?.message}
                    fullWidth
                    label={`Price In - ${index + 1}`}
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
