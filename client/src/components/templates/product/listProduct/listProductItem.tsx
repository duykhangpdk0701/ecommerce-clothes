import { LazyLoadImage } from "react-lazy-load-image-component";
import Link from "next/link";
import React, { FC, useState } from "react";
//mui component
import Paper from "@mui/material/Paper";
import Grid from "@mui/material/Grid";
import Rating from "@mui/material/Rating";
import DialogTitle from "@mui/material/DialogTitle";
import DialogContent from "@mui/material/DialogContent";
import AddIcon from "@mui/icons-material/Add";
import CloseIcon from "@mui/icons-material/Close";
import IconButton from "@mui/material/IconButton";
import Dialog from "@mui/material/Dialog";
import Typography from "@mui/material/Typography";
import Button from "@mui/material/Button";

interface IListProductItem {
  slug: string;
  name: string;
  price: string;
  thumbnail: string;
}

const ListProductItem: FC<IListProductItem> = (props) => {
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
      <Paper className="mb-5">
        <Grid container columnSpacing={1}>
          <Grid item xs={12} sm={3}>
            <div className="relative">
              <LazyLoadImage
                src={thumbnail}
                alt="thumbnail"
                className="w-full"
              />
            </div>
          </Grid>
          <Grid item xs={12} sm={9}>
            <div className="flex flex-col justify-center h-full p-4">
              <Link
                href={`/product/${slug}`}
                className="no-underline text-color-black"
              >
                <Typography
                  variant="h5"
                  className="my-2 font-semibold text-base"
                >
                  {name}
                </Typography>
              </Link>
              <Rating className="text-xl" value={4} readOnly />
              <div className="flex items-center mt-2 mb-4">
                <Typography
                  variant="h5"
                  className="text-color-price text-base font-semibold"
                >
                  From {price} US$
                </Typography>
              </div>
              <div>
                <Button
                  variant="contained"
                  disableElevation
                  onClick={handleOpenDialog}
                >
                  Add To Cart
                </Button>
              </div>
            </div>
          </Grid>
        </Grid>
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

export default ListProductItem;
