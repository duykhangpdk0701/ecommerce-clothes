import AddIcon from "@mui/icons-material/Add";
import CloseIcon from "@mui/icons-material/Close";
import RemoveIcon from "@mui/icons-material/Remove";

import Box from "@mui/material/Box";
import Button from "@mui/material/Button";
import IconButton from "@mui/material/IconButton";
import Paper from "@mui/material/Paper";
import CircularProgress from "@mui/material/CircularProgress";

import Link from "next/link";
import React, { FC, useState } from "react";
import { useMutation, useQueryClient } from "react-query";
import cartAPI from "@/api/cartAPI";
import { IQuoteDetail } from "@/interfaces/Quotes";
import { LazyLoadImage } from "react-lazy-load-image-component";
import Loading from "@/components/shared/loading";

interface ICartItem {
  data: IQuoteDetail;
}

interface IItemQuantityToCart {
  quoteDetailId: number;
  quoteId: number;
}

const CartItem: FC<ICartItem> = (props) => {
  const { data } = props;
  const [loading, setLoading] = useState(false);
  const queryClient = useQueryClient();

  const plusItemQuantityToCartMutation = useMutation({
    mutationKey: ["cart"],
    mutationFn: ({ quoteDetailId, quoteId }: IItemQuantityToCart) =>
      cartAPI.plusItemQuantity(quoteDetailId, quoteId),
  });

  const minusItemQuantityToCartMutation = useMutation({
    mutationKey: ["cart"],
    mutationFn: ({ quoteDetailId, quoteId }: IItemQuantityToCart) =>
      cartAPI.minusItemQuantity(quoteDetailId, quoteId),
  });

  const deleteItemToCartMutation = useMutation({
    mutationKey: ["cart"],
    mutationFn: ({ quoteDetailId, quoteId }: IItemQuantityToCart) =>
      cartAPI.deleleteItemQuantity(quoteDetailId, quoteId),
  });

  const handleClickPlus = async () => {
    setLoading(true);
    const quoteId = sessionStorage.getItem("quoteId");
    if (quoteId) {
      await plusItemQuantityToCartMutation.mutateAsync({
        quoteDetailId: data.id,
        quoteId: parseInt(quoteId),
      });
      await queryClient.refetchQueries(["cart"]);
    }
    setLoading(false);
  };

  const handleClickMinus = async () => {
    setLoading(true);
    const quoteId = sessionStorage.getItem("quoteId");
    if (quoteId) {
      await minusItemQuantityToCartMutation.mutateAsync({
        quoteDetailId: data.id,
        quoteId: parseInt(quoteId),
      });
      await queryClient.refetchQueries(["cart"]);
    }
    setLoading(false);
  };

  const handleClickDelete = async () => {
    setLoading(true);
    const quoteId = sessionStorage.getItem("quoteId");
    if (quoteId) {
      await deleteItemToCartMutation.mutateAsync({
        quoteDetailId: data.id,
        quoteId: parseInt(quoteId),
      });
    }
    setLoading(false);
  };

  return (
    <Paper className="mb-5 flex relative">
      {loading && <Loading />}
      <div className="w-[140px] h-[140px]">
        <LazyLoadImage src={data.item.thumbnail_url} />
      </div>
      <IconButton
        size="small"
        className="absolute right-4 top-4 "
        onClick={handleClickDelete}
      >
        <CloseIcon fontSize="small" />
      </IconButton>
      <div className="flex-1 flex flex-col justify-between p-4">
        <div>
          <Link href="/product/1" passHref legacyBehavior>
            <span className="text-lg font-semibold">{data.item.name}</span>
          </Link>
        </div>
        <div className="flex gap-2">
          <span className="text-[#7D879C] font-medium text-base">
            210,00 US$ x {data.quantity}
          </span>
          <span className="text-[#1976d2] font-medium text-base">
            210,00 US$
          </span>
        </div>
        <div>
          <Button
            onClick={handleClickMinus}
            disabled
            variant="outlined"
            className="min-w-0 p-1"
          >
            <RemoveIcon fontSize="small" />
          </Button>
          <span className="mx-2 font-medium text-base">{data.quantity}</span>
          <Button
            onClick={handleClickPlus}
            variant="outlined"
            className="min-w-0 p-1"
          >
            <AddIcon fontSize="small" />
          </Button>
        </div>
      </div>
    </Paper>
  );
};

export default CartItem;
