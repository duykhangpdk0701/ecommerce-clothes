import itemAPI from "@/api/itemAPI";
import ProductDetailTemplate from "@/components/templates/product/productDetails";
import ProductContent from "@/components/templates/product/productDetails/ProductContent";
import HomeLayout from "@/layout/HomeLayout";
import { useRouter } from "next/router";
import React, { ReactElement, useState } from "react";
import { useQuery } from "react-query";
import { NextPageWithLayout } from "@/pages/_app";
import { useForm } from "react-hook-form";
import * as yup from "yup";
import { yupResolver } from "@hookform/resolvers/yup";
import Head from "next/head";

export interface IProductDetailParmas {
  itemColor: number;
  itemSize: number;
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

  const { control, handleSubmit } = useForm<IProductDetailParmas>({
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

  return (
    <>
      <Head>
        <title>{slug} | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ProductDetailTemplate
        productContent={
          <ProductContent control={control} itemDetail={itemDetail.data} />
        }
      />
    </>
  );
};

ProductDetail.getLayout = function getLayout(page: ReactElement) {
  return <HomeLayout>{page}</HomeLayout>;
};

export default ProductDetail;
