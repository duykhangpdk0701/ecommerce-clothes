import { Add, Close } from "@mui/icons-material";
import {
  Button,
  Dialog,
  DialogContent,
  DialogTitle,
  Grid,
  IconButton,
  Paper,
  Rating,
} from "@mui/material";
import Link from "next/link";
import React, { useState } from "react";
import { TEXT_COLOR_BLACK, TEXT_COLOR_PRICE } from "@/styles/color";
import productWebp from "@/assets/8.webp";
import Image from "next/image";

const ProductItem = () => {
  const [open, setOpen] = useState(false);

  const handleOpenDialog = () => {
    setOpen(true);
  };

  const handleCloseDialog = () => {
    setOpen(false);
  };

  return (
    <>
      <Grid item xs={4}>
        <Paper>
          <Link href={`/product/t-shirt`}>
            <div className="overflow-hidden relative">
              <span className="block pt-[100%]"></span>
              <Image
                className="aspect-square"
                src={productWebp.src}
                alt="productItem"
                fill
                sizes="100vw"
              />
            </div>
          </Link>
          <div className="p-4">
            <div className="flex">
              <div className="flex-1 mr-2">
                <Link href={`/product/t-shirt`} className="no-underline">
                  <h3
                    className="text-sm font-semibold mb-2"
                    style={{ color: TEXT_COLOR_BLACK }}
                  >
                    Police Gray Eyeglasses
                  </h3>
                </Link>
                <Rating className="text-xl" value={4} readOnly />
                <div className="mt-1">
                  <span
                    className="font-semibold"
                    style={{ color: TEXT_COLOR_PRICE }}
                  >
                    187,00 US$
                  </span>
                </div>
              </div>
              <div className="flex flex-col justify-end">
                <Button
                  onClick={handleOpenDialog}
                  variant="outlined"
                  className="min-w-0 p-1"
                >
                  <Add fontSize="small" />
                </Button>
              </div>
            </div>
          </div>
        </Paper>
      </Grid>
      <Dialog open={open} onClose={handleCloseDialog}>
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
            <Close />
          </IconButton>
        </DialogTitle>
        <DialogContent>
          <Grid container>
            <Grid item xs={6}></Grid>
            <Grid item xs={6}></Grid>
          </Grid>

          <div>hello my name is khang</div>
        </DialogContent>
      </Dialog>
    </>
  );
};

export default ProductItem;
