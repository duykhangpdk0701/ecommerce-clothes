import itemAPI from "@/api/itemAPI";
import ProductDetailTemplate from "@/components/templates/product/productDetails";
import ProductContent from "@/components/templates/product/productDetails/ProductContent";
import HomeLayout from "@/layout/HomeLayout";
import { useRouter } from "next/router";
import React, { ReactElement, useState } from "react";
import { useMutation, useQuery, useQueryClient } from "react-query";
import { NextPageWithLayout } from "@/pages/_app";
import { useForm } from "react-hook-form";
import * as yup from "yup";
import { yupResolver } from "@hookform/resolvers/yup";
import Head from "next/head";
import { SubmitHandler } from "react-hook-form/dist/types";
import cartAPI from "@/api/cartAPI";

export interface IProductDetailParams {
  itemColor: number;
  itemSize: number;
  quantity: number;
}

interface IAddToCart {
  itemVariantId: number;
  quantity: number;
}

const addItemToCartSchema = yup.object({
  itemColor: yup.number().required(),
  itemSize: yup.number().required(),
  quantity: yup.number().required(),
});

const ProductDetail: NextPageWithLayout = () => {
  const router = useRouter();
  const { slug } = router.query;
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);
  const queryClient = useQueryClient();

  const { control, handleSubmit } = useForm<IProductDetailParams>({
    defaultValues: {
      quantity: 1,
    },
    resolver: yupResolver(addItemToCartSchema),
  });

  const itemDetail = useQuery({
    queryKey: ["item-detail", slug],
    queryFn: () => {
      setLoading(true);
      if (slug && typeof slug !== "object") {
        return itemAPI.getItemBySlug(slug);
      }
      return undefined;
    },
    onSuccess: () => {
      setLoading(false);
    },
    onError: () => {
      setLoading(true);
    },
  });

  const addItemToCartMutate = useMutation({
    mutationKey: ["cart"],
    mutationFn: ({ itemVariantId, quantity }: IAddToCart) => {
      const quoteId = sessionStorage.getItem("quoteId");
      if (quoteId) {
        return cartAPI.addToCart(itemVariantId, parseInt(quoteId), quantity);
      }
      return cartAPI.createCart(itemVariantId, quantity);
    },
    onSuccess: async (data) => {
      sessionStorage.setItem("quouteId", data.id.toString());
      await queryClient.refetchQueries(["cart"]);
    },
  });

  const onSubmit: SubmitHandler<IProductDetailParams> = async (data) => {
    const { itemColor, itemSize, quantity } = data;
    if (itemDetail.data) {
      const { variants } = itemDetail.data;
      const vairant = variants.find((value) => {
        return value.color_id === itemColor && value.size_id === itemSize;
      });
      console.log(vairant?.id);
      if (vairant) {
        addItemToCartMutate.mutate({ itemVariantId: vairant.id, quantity });
      }
    }
  };

  return (
    <>
      <Head>
        <title>{slug} | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ProductDetailTemplate
        productContent={
          <ProductContent
            isLoading={loading}
            control={control}
            onSubmit={onSubmit}
            handleSubmit={handleSubmit}
            itemDetail={itemDetail.data}
          />
        }
      />
    </>
  );
};

ProductDetail.getLayout = function getLayout(page: ReactElement) {
  return <HomeLayout>{page}</HomeLayout>;
};

export default ProductDetail;
