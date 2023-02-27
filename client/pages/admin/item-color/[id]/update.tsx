import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import React, { ReactElement, useState } from "react";
import { NextPageWithLayout } from "@/pages/_app";
import * as yup from "yup";
import { useRouter } from "next/router";
import { yupResolver } from "@hookform/resolvers/yup";
import { useMutation, useQuery } from "react-query";
import { SubmitHandler, useForm } from "react-hook-form";
import adminItemColorAPI from "@/api/admin/adminItemColor";
import UpdateItemColorTemplate from "@/components/templates/admin/itemColor/update";
import { useDispatch } from "react-redux";
import { setSnackbar } from "@/contexts/slices/snackbarSlice";

export interface IUpdateItemColorParams {
  name: string;
  value: string;
  status: boolean;
  order: number;
}

const updateItemColorSchema = yup.object({
  name: yup.string().required(),
  value: yup.string().required(),
  status: yup.boolean().required(),
  order: yup.number().required(),
});

const UpdateItemColor: NextPageWithLayout = () => {
  const router = useRouter();
  const { id } = router.query;
  const dispatch = useDispatch();
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  const {
    control,
    handleSubmit,
    setValue,
    formState: { errors },
  } = useForm<IUpdateItemColorParams>({
    defaultValues: { name: "", order: 0 },
    resolver: yupResolver(updateItemColorSchema),
  });

  const itemSizeQuery = useQuery({
    queryKey: ["item-color", id],
    queryFn: () => {
      setLoading(true);
      if (id && typeof id !== "object") {
        return adminItemColorAPI.getItemColorById(id);
      }
      return;
    },
    onSuccess: (data) => {
      console.log(data?.order);
      data?.name && setValue("name", data.name);
      data?.value && setValue("value", data.value);
      data?.order && setValue("order", data.order);
      data?.status && setValue("status", data.status);
      setLoading(false);
    },
    onError: (error: any) => {
      console.log(error);
      setLoading(false);
    },
  });

  const updateItemColorMutation = useMutation({
    mutationKey: "item-color",
    mutationFn: ({ name, value, order, status }: IUpdateItemColorParams) => {
      setLoading(true);

      return adminItemColorAPI.updateItemColor(
        id as string,
        name,
        value,
        order,
        status
      );
    },
    onSuccess: async (data) => {
      await router.push("/admin/item-color");
      setLoading(false);
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "success",
          snackbarMessage: "Update Item Color successfully",
        })
      );
    },
    onError: (error: any) => {
      setLoading(false);
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "error",
          snackbarMessage: error.message,
        })
      );
    },
  });

  const onSubmit: SubmitHandler<IUpdateItemColorParams> = (data) => {
    const { name, value, order, status } = data;
    updateItemColorMutation.mutate({ name, value, order, status });
  };

  return (
    <>
      <Head>
        <title>Item Color Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <UpdateItemColorTemplate
        control={control}
        handleSubmit={handleSubmit}
        onSubmit={onSubmit}
        errors={errors}
        isLoading={loading}
        errorResMessage={error}
      />
    </>
  );
};

UpdateItemColor.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default UpdateItemColor;
