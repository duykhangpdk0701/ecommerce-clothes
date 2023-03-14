import React, { FC } from "react";

import Dialog from "@mui/material/Dialog";
import Grid from "@mui/material/Grid";
import Rating from "@mui/material/Rating";
import DialogTitle from "@mui/material/DialogTitle";
import DialogContent from "@mui/material/DialogContent";
import IconButton from "@mui/material/IconButton";
import Typography from "@mui/material/Typography";
import Divider from "@mui/material/Divider";
import Button from "@mui/material/Button";

import CloseIcon from "@mui/icons-material/Close";
import RemoveIcon from "@mui/icons-material/Remove";
import AddIcon from "@mui/icons-material/Add";

import { LazyLoadImage } from "react-lazy-load-image-component";
import { sentenceCase } from "change-case";
import { useAppDispatch, useAppSelector } from "@/hooks/redux";
import {
  removeSlugDialogAction,
  setCloseDialogAction,
} from "@/contexts/slices/dialogItem";
import { useQuery } from "react-query";
import itemAPI from "@/api/itemAPI";
import { Controller, useForm } from "react-hook-form";
import * as yup from "yup";
import { yupResolver } from "@hookform/resolvers/yup";
import { SubmitHandler } from "react-hook-form/dist/types";

export interface IViewProductDialogParams {
  itemColor: number;
  itemSize: number;
  quantity: number;
}

const viewProductDialogSchema = yup.object({
  itemColor: yup.number().required(),
  itemSize: yup.number().required(),
  quantity: yup.number().required(),
});

const ViewProductDialog: FC = () => {
  const dispatch = useAppDispatch();

  const openDialog = useAppSelector((state) => state.DialogItem.toggle);
  const itemSlugState = useAppSelector((state) => state.DialogItem.itemSlug);

  const { control, handleSubmit } = useForm<IViewProductDialogParams>({
    defaultValues: {
      quantity: 1,
    },
    resolver: yupResolver(viewProductDialogSchema),
  });

  const handleCloseDialog = () => {
    dispatch(setCloseDialogAction());
    setTimeout(() => {
      dispatch(removeSlugDialogAction());
    }, 300);
  };

  const productDetailQuery = useQuery({
    queryKey: ["item-detail", itemSlugState],
    queryFn: () => {
      if (itemSlugState) {
        return itemAPI.getItemBySlug(itemSlugState);
      }
      return;
    },
  });

  const onFinish: SubmitHandler<IViewProductDialogParams> = async (data) => {
    console.log(data);
  };

  return (
    <Dialog open={openDialog} onClose={handleCloseDialog}>
      <DialogTitle>
        <IconButton
          aria-label="close"
          onClick={handleCloseDialog}
          sx={{
            position: "absolute",
            right: 3,
            top: 3,
            color: (theme) => theme.palette.grey[500],
          }}
        >
          <CloseIcon />
        </IconButton>
      </DialogTitle>
      <DialogContent className="py-5 px-6">
        <Grid container spacing={3}>
          <Grid item xs={12} md={6}>
            <LazyLoadImage
              src={productDetailQuery.data?.thumbnail_url}
              alt={productDetailQuery.data?.name}
            />
          </Grid>
          <Grid item xs={12} md={6}>
            <form onSubmit={handleSubmit(onFinish)}>
              <Typography variant="h2" className="text-2xl font-bold">
                {productDetailQuery.data?.name &&
                  sentenceCase(productDetailQuery.data?.name)}
              </Typography>
              <p className="text-color-gray py-2 font-semibold">
                CATEGORY: Cosmetic
              </p>
              <Typography
                variant="h1"
                className="text-3xl text-color-price font-bold"
              >
                {productDetailQuery.data?.stock_lowest_price} US$
              </Typography>
              <Rating className="text-xl" value={4} readOnly />
              <p className="my-4">
                <div
                  dangerouslySetInnerHTML={{
                    __html: productDetailQuery.data?.description || "",
                  }}
                ></div>
              </p>
              <Divider />

              <div>
                <Typography variant="h6" className="mb-2 text-sm font-semibold">
                  Quantity
                </Typography>
                <Controller
                  name="quantity"
                  control={control}
                  render={({ field: { value, onChange } }) => (
                    <div className="flex items-center">
                      <Button
                        size="small"
                        variant="outlined"
                        className="min-w-0 p-1"
                        onClick={() => onChange(value - 1)}
                        disabled={value < 2 ? true : false}
                      >
                        <RemoveIcon />
                      </Button>
                      <h3 className="mx-5 text-xl">{value}</h3>
                      <Button
                        size="small"
                        variant="outlined"
                        className="min-w-0 p-1"
                        onClick={() => onChange(value + 1)}
                      >
                        <AddIcon />
                      </Button>
                    </div>
                  )}
                />
              </div>

              <Button
                type="submit"
                variant="contained"
                className="mb-9 px-7"
                size="medium"
              >
                Add to cart
              </Button>
            </form>
          </Grid>
        </Grid>
      </DialogContent>
    </Dialog>
  );
};

export default ViewProductDialog;
