import UpdateBrandTemplate from "@/components/templates/admin/brand/UpdateBrand";
import { yupResolver } from "@hookform/resolvers/yup";
import Head from "next/head";
import React, { ReactElement, useState } from "react";
import * as yup from "yup";
import { SubmitHandler, useForm } from "react-hook-form";
import { useMutation, useQuery } from "react-query";
import adminBrandAPI from "@/api/admin/adminBrandAPI";
import { useRouter } from "next/router";
import { NextPageWithLayout } from "@/pages/_app";
import AdminLayout from "@/layout/AdminLayout";
import { useAppDispatch } from "@/hooks/redux";
import { setSnackbar } from "@/contexts/slices/snackbarSlice";

export interface IUpdateBrandParams {
  name: string;
  slug: string;
  status: boolean;
  order: number;
}
const updateBrandSchema = yup.object({
  name: yup.string().required(),
  slug: yup.string().required(),
  status: yup.boolean().required(),
  order: yup.string().required(),
});

const UpdateAdminBrand: NextPageWithLayout = () => {
  const router = useRouter();
  const { slug, id } = router.query;
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");
  const dispatch = useAppDispatch();

  const {
    control,
    handleSubmit,
    setValue,
    formState: { errors },
  } = useForm<IUpdateBrandParams>({
    defaultValues: {
      name: "",
      slug: "",
      order: 0,
      status: false,
    },
    resolver: yupResolver(updateBrandSchema),
  });

  const updateBrandMutation = useMutation({
    mutationKey: ["brand"],
    mutationFn: ({ name, slug, order, status }: IUpdateBrandParams) => {
      setLoading(true);
      return adminBrandAPI.updateBrand(id as string, name, slug, order, status);
    },
    onSuccess: async (data) => {
      await getBrandBySlugQuery.refetch();
      await router.push("/admin/brand");
      setLoading(false);
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "success",
          snackbarMessage: "Create Item Color successfully",
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

  const getBrandBySlugQuery = useQuery({
    queryKey: ["brand", id],
    queryFn: () => {
      setLoading(true);
      if (id && typeof id !== "object") {
        return adminBrandAPI.getBrandById(id);
      }
      return;
    },
    onSuccess: async (data) => {
      data?.name && setValue("name", data.name);
      data?.slug && setValue("slug", data.slug);
      data?.order && setValue("order", data.order);
      data?.status && setValue("status", data.status);
      setLoading(false);
    },
    onError: (error: any) => {
      console.log(error);
      setLoading(false);
    },
  });

  const onSubmit: SubmitHandler<IUpdateBrandParams> = (data) => {
    const { name, slug, order, status } = data;
    updateBrandMutation.mutate({ name, slug, order, status });
    console.log(data);
  };

  return (
    <>
      <Head>
        <title>Brand Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <UpdateBrandTemplate
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

UpdateAdminBrand.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};
export default UpdateAdminBrand;
