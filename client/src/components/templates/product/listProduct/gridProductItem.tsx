import AddIcon from "@mui/icons-material/Add";
import CloseIcon from "@mui/icons-material/Close";

import Link from "next/link";
import React, { FC, useState } from "react";
import productWebp from "@/assets/8.webp";
import Image from "next/image";
// mui component
import Button from "@mui/material/Button";
import Dialog from "@mui/material/Dialog";
import Grid from "@mui/material/Grid";
import Paper from "@mui/material/Paper";
import Rating from "@mui/material/Rating";
import DialogTitle from "@mui/material/DialogTitle";
import DialogContent from "@mui/material/DialogContent";
import IconButton from "@mui/material/IconButton";

import { sentenceCase } from "change-case";
import { LazyLoadImage } from "react-lazy-load-image-component";

interface IGridProductItem {
  slug: string;
  name: string;
  price: string;
  thumbnail: string;
}

const GridProductItem: FC<IGridProductItem> = (props) => {
  const { slug, name, price, thumbnail } = props;
  const [open, setOpen] = useState(false);

  const handleOpenDialog = () => {
    setOpen(true);
  };

  const handleCloseDialog = () => {
    setOpen(false);
  };

  return (
    <>
      <Paper>
        <Link href={`/product/${slug}`}>
          <div className="overflow-hidden relative">
            <LazyLoadImage
              className="aspect-square"
              src={thumbnail}
              alt="thumbnail"
            />
          </div>
        </Link>
        <div className="p-4">
          <div className="flex">
            <div className="flex-1 mr-2">
              <Link href={`/product/${slug}`} className="no-underline">
                <h3 className="text-sm font-semibold mb-2 text-color-black">
                  {sentenceCase(name)}
                </h3>
              </Link>
              <Rating className="text-xl" value={4} readOnly />
              <div className="mt-1">
                <span className="font-semibold text-color-price">
                  From {price} US$
                </span>
              </div>
            </div>
            <div className="flex flex-col justify-end">
              <Button
                onClick={handleOpenDialog}
                variant="outlined"
                className="min-w-0 p-1"
              >
                <AddIcon fontSize="small" />
              </Button>
            </div>
          </div>
        </div>
      </Paper>
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
            <CloseIcon />
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

export default GridProductItem;
