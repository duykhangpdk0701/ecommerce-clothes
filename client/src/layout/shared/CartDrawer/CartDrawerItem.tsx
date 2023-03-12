import Link from "next/link";
import React, { FC, useState } from "react";
//mui component
import Button from "@mui/material/Button";
import IconButton from "@mui/material/IconButton";
import Avatar from "@mui/material/Avatar";
//mui icon
import CloseIcon from "@mui/icons-material/Close";
import AddIcon from "@mui/icons-material/Add";
import RemoveIcon from "@mui/icons-material/Remove";
import { IQuoteDetail } from "@/interfaces/Quotes";
import { LazyLoadImage } from "react-lazy-load-image-component";
import { sentenceCase } from "change-case";
import { useMutation, useQueryClient } from "react-query";
import cartAPI from "@/api/cartAPI";
import Loading from "@/components/shared/loading";

interface ICartDrawerItem {
  data: IQuoteDetail;
}

interface IItemQuantityToCart {
  quoteDetailId: number;
  quoteId: number;
}

const CartDrawerItem: FC<ICartDrawerItem> = (props) => {
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

  const { data } = props;

  return (
    <div className="px-5 py-4 flex items-center border-0 border-b border-solid border-color-gray relative">
      {loading && <Loading />}
      <div className="flex flex-col items-center">
        <Button
          size="small"
          variant="outlined"
          className="min-w-0 p-1 rounded-full"
          onClick={handleClickPlus}
        >
          <AddIcon />
        </Button>

        <span className="my-1">{data.quantity}</span>
        <Button
          size="small"
          variant="outlined"
          className="min-w-0 p-1 rounded-full"
          onClick={handleClickMinus}
        >
          <RemoveIcon />
        </Button>
      </div>
      <Link href="/product/silver">
        <Avatar variant="square" className="bg-white w-[76px] h-[76px] mx-4">
          <LazyLoadImage src={data.item.thumbnail_url} alt="product1" />
        </Avatar>
      </Link>
      <div className="text-ellipsis overflow-hidden flex-1 whitespace-nowrap">
        <Link href="/product/silver" className="no-underline text-color-black">
          <h5 className="text-sm font-semibold overflow-hidden text-ellipsis whitespace-nowrap ">
            {sentenceCase(data.item.name)}
          </h5>
        </Link>
        <span className="text-xs mt-1 block text-color-gray">
          {data.item_price} US$ x {data.quantity}
        </span>
        <span className="text-sm font-semibold mt-1 block">210,00 US$</span>
      </div>
      <IconButton className="ml-5">
        <CloseIcon />
      </IconButton>
    </div>
  );
};

export default CartDrawerItem;
