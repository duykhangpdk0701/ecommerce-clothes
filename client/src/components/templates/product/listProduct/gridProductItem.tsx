import AddIcon from "@mui/icons-material/Add";

import Link from "next/link";
import React, { FC } from "react";
// mui component
import Button from "@mui/material/Button";

import Paper from "@mui/material/Paper";
import Rating from "@mui/material/Rating";

import { sentenceCase } from "change-case";
import { LazyLoadImage } from "react-lazy-load-image-component";
import { useAppDispatch, useAppSelector } from "@/hooks/redux";
import { setOpenDialogAction } from "@/contexts/slices/dialogItem";

interface IGridProductItem {
  slug: string;
  name: string;
  price: string;
  thumbnail: string;
}

const GridProductItem: FC<IGridProductItem> = (props) => {
  const { slug, name, price, thumbnail } = props;
  const dispatch = useAppDispatch();

  const handleOpenDialog = () => {
    dispatch(setOpenDialogAction({ itemSlug: slug }));
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
    </>
  );
};

export default GridProductItem;
